<?php

namespace App\Services;

use Google_Client;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Str;
use Exception;

class FirestoreRestClient
{
    protected string $projectId;
    protected string $credentialsPath;
    protected Google_Client $googleClient;
    protected GuzzleClient $http;

    public function __construct(string $projectId, string $credentialsPath)
    {
        $this->projectId = $projectId;
        $this->credentialsPath = $credentialsPath;

        $this->googleClient = new Google_Client();
        $this->googleClient->setAuthConfig(base_path($this->credentialsPath));
        $this->googleClient->addScope('https://www.googleapis.com/auth/datastore');

        $this->http = new GuzzleClient([
            'base_uri' => "https://firestore.googleapis.com/v1/projects/{$this->projectId}/databases/(default)/",
            'timeout'  => 30,
        ]);
    }

    protected function getAccessToken(): string
    {
        $tokenArray = $this->googleClient->fetchAccessTokenWithAssertion();
        if (isset($tokenArray['access_token'])) {
            return $tokenArray['access_token'];
        }
        throw new Exception('Não foi possível obter access_token do Google Client: ' . json_encode($tokenArray));
    }

    protected function authHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * Converte um valor PHP para o formato Firestore REST "Value".
     */
    protected function formatValue($value)
    {
        // null
        if ($value === null) {
            return ['nullValue' => null];
        }

        // boolean
        if (is_bool($value)) {
            return ['booleanValue' => $value];
        }

        // integer (Firestore expects integerValue as string)
        if (is_int($value)) {
            return ['integerValue' => (string) $value];
        }

        // float/double
        if (is_float($value)) {
            return ['doubleValue' => (float) $value];
        }

        // DateTimeInterface -> string ISO
        if ($value instanceof \DateTimeInterface) {
            return ['stringValue' => $value->format(\DateTime::ATOM)];
        }

        // arrays
        if (is_array($value)) {
            // Distinguish between associative arrays (map) and indexed arrays (list)
            if ($this->isAssoc($value)) {
                // mapValue expects 'fields' => [...]
                $fields = $this->toFirestoreFields($value);
                return ['mapValue' => ['fields' => $fields]];
            } else {
                // array of values -> arrayValue with 'values' => [ {value}, ... ]
                $values = [];
                foreach ($value as $v) {
                    $values[] = $this->formatValue($v);
                }
                return ['arrayValue' => ['values' => $values]];
            }
        }

        // numeric strings? try to detect integers/floats in string form
        if (is_string($value)) {
            // ISO date string? keep as stringValue (you can customize detection)
            return ['stringValue' => $value];
        }

        // fallback: convert to string
        return ['stringValue' => (string) $value];
    }

    /**
     * Converte um array associativo PHP para 'fields' esperado pelo Firestore.
     */
    protected function toFirestoreFields(array $data): array
    {
        $fields = [];
        foreach ($data as $k => $v) {
            // Normaliza nomes vazios/nulos
            if ($v === null) {
                $fields[$k] = ['nullValue' => null];
                continue;
            }

            // Se for um Carbon (ou similar), converta pra ISO string
            if ($v instanceof \DateTimeInterface) {
                $fields[$k] = ['stringValue' => $v->format(\DateTime::ATOM)];
                continue;
            }

            // Se for um objeto que implementa toArray (ex: Eloquent), converta recursivamente
            if (is_object($v) && method_exists($v, 'toArray')) {
                $v = $v->toArray();
            } elseif (is_object($v)) {
                // objetos sem toArray -> string
                $v = (string) $v;
            }

            $fields[$k] = $this->formatValue($v);
        }
        return $fields;
    }

    protected function isAssoc(array $arr): bool
    {
        if ([] === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    protected function documentUrl(string $collection, ?string $documentId = null): string
    {
        if ($documentId) {
            return "documents/{$collection}/" . rawurlencode((string)$documentId);
        }
        return "documents/{$collection}";
    }

    public function setDocument(string $collection, string $documentId, array $data): array
    {
        $url = $this->documentUrl($collection, $documentId);
        $body = ['fields' => $this->toFirestoreFields($data)];

        $response = $this->http->request('PATCH', $url, [
            'headers' => $this->authHeaders(),
            'json' => $body,
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function getDocument(string $collection, string $documentId): ?array
    {
        $url = $this->documentUrl($collection, $documentId);
        try {
            $response = $this->http->request('GET', $url, [
                'headers' => $this->authHeaders(),
            ]);
            return json_decode((string) $response->getBody(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if ($e->getResponse()->getStatusCode() === 404) {
                return null;
            }
            throw $e;
        }
    }

    public function deleteDocument(string $collection, string $documentId): bool
    {
        $url = $this->documentUrl($collection, $documentId);
        $response = $this->http->request('DELETE', $url, [
            'headers' => $this->authHeaders(),
        ]);
        return $response->getStatusCode() === 200 || $response->getStatusCode() === 204;
    }

    public function listDocuments(string $collection, int $pageSize = 100): array
    {
        $fullUrl = "documents/{$collection}";
        $response = $this->http->request('GET', $fullUrl, [
            'headers' => $this->authHeaders(),
            'query' => ['pageSize' => $pageSize],
        ]);
        $json = json_decode((string) $response->getBody(), true);
        return $json;
    }
}
