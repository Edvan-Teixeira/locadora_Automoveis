<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\FirestoreRestClient;
use Illuminate\Support\Arr;
use Exception;

class Veiculo extends Model
{
    // Mantemos nome da tabela para caso volte a usar Eloquent
    protected $table = 'veiculos';

    protected $fillable = [
        'marca','modelo','ano','placa','cor','imagem','valor_diaria'
    ];

    /**
     * Decide se estamos usando Firestore
     */
    protected static function useFirestore(): bool
    {
        return (bool) config('firebase.enabled');
    }

    /**
     * Helper para instanciar o client REST (ou instancia direto)
     */
    protected static function firestoreClient(): FirestoreRestClient
    {
        // construí um novo client aqui (padrão simples)
        $projectId = config('firebase.project_id');
        $credentials = config('firebase.credentials');
        return new FirestoreRestClient($projectId, $credentials);
    }

    // -----------------------
    // Static methods override
    // -----------------------

    /**
 * Recupera todos os documentos (simples)
 */
public static function all($columns = ['*'])
{
    if (!static::useFirestore()) {
        return parent::all($columns);
    }

    $client = static::firestoreClient();
    $rows = $client->listDocuments('veiculos');
    // transformar arrays em "instâncias" do model para compat com views
    $models = [];
    foreach ($rows as $r) {
        $m = new static();
        $m->exists = true;
        $m->attributes = Arr::except($r, ['id']);
        $m->setAttribute('id', $r['id'] ?? null);
        $models[] = $m;
    }
    return collect($models);
}
    /**
     * Find by id (retorna instancia do Model ou null)
     */
    public static function find($id, $columns = ['*'])
    {
        if (!static::useFirestore()) {
            return parent::find($id, $columns);
        }

        $client = static::firestoreClient();
        $doc = $client->getDocument('veiculos', (string)$id);
        if (!$doc) return null;

        $m = new static();
        $m->exists = true;
        $m->attributes = Arr::except($doc, ['id']);
        $m->setAttribute('id', $doc['id'] ?? null);
        return $m;
    }

    /**
     * Find or fail
     */
    public static function findOrFail($id, $columns = ['*'])
    {
        $res = static::find($id, $columns);
        if ($res === null) {
            throw (new \Illuminate\Database\Eloquent\ModelNotFoundException())->setModel(static::class, $id);
        }
        return $res;
    }

    /**
     * Create (static)
     */
    public static function create(array $attributes = [])
    {
        if (!static::useFirestore()) {
            return parent::create($attributes);
        }

        $client = static::firestoreClient();
        // gera id único ou permita que client gere
        $id = (string) uniqid();
        $client->setDocument('veiculos', $id, $attributes);

        $m = new static();
        $m->exists = true;
        $m->attributes = $attributes;
        $m->setAttribute('id', $id);
        return $m;
    }

    // -----------------------
    // Instance methods override
    // -----------------------

    /**
     * save() - cria ou atualiza no firestore
     */
    public function save(array $options = [])
    {
        if (!static::useFirestore()) {
            return parent::save($options);
        }

        $client = static::firestoreClient();
        $id = (string) ($this->getAttribute('id') ?? $this->attributes['id'] ?? uniqid());
        // garante array de atributos salvo
        $data = $this->getAttributes();
        // remove id do payload
        unset($data['id']);
        $client->setDocument('veiculos', $id, $data);
        $this->setAttribute('id', $id);
        $this->exists = true;
        return true;
    }

    /**
     * update() - atualiza atributos e salva
     */
    public function update(array $attributes = [], array $options = [])
    {
        if (!static::useFirestore()) {
            return parent::update($attributes, $options);
        }

        $this->fill($attributes);
        return $this->save($options);
    }

    /**
     * delete() - deleta do firestore
     */
    public function delete()
    {
        if (!static::useFirestore()) {
            return parent::delete();
        }

        $id = (string) $this->getAttribute('id');
        if (!$id) return false;
        $client = static::firestoreClient();
        $client->deleteDocument('veiculos', $id);
        $this->exists = false;
        return true;
    }

    // -----------------------
    // Route model binding (mantém comportamento de controllers que recebem Veiculo $veiculo)
    // -----------------------
    public function getRouteKey()
    {
        return $this->getAttribute('id') ?? parent::getRouteKey();
    }

    public function resolveRouteBinding($value, $field = null)
    {
        if (!static::useFirestore()) {
            return parent::resolveRouteBinding($value, $field);
        }
        return static::findOrFail($value);
    }
}
