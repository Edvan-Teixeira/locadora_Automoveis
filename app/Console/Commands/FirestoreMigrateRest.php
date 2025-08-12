<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FirestoreRestClient;
use App\Models\Cliente;
use App\Models\Veiculo;
use App\Models\Locacao;
use App\Models\Financeiro;
use App\Models\User;

class FirestoreMigrateRest extends Command
{
    protected $signature = 'firebase:push:rest {--collections=*}';
    protected $description = 'Migra dados do SQLite para Firestore via REST (sem ext-grpc)';

    protected FirestoreRestClient $client;

    public function __construct()
    {
        parent::__construct();

        $projectId = config('firebase.project_id');
        $credentials = config('firebase.credentials');

        $this->client = new FirestoreRestClient($projectId, $credentials);
    }

    public function handle()
    {
        $collections = $this->option('collections') ?: ['clientes','veiculos','locacoes','financeiro','users'];

        if (in_array('clientes', $collections)) {
            $this->info('Migrando clientes...');
            Cliente::chunk(200, function ($clientes) {
                foreach ($clientes as $c) {
                    $data = $c->toArray();
                    // normalizar datas -> string ISO
                    if (!empty($data['data_nascimento'])) {
                        $data['data_nascimento'] = $c->data_nascimento?->toDateTimeString();
                    }
                    $this->client->setDocument('clientes', (string)$c->id, $data);
                }
            });
        }

        if (in_array('veiculos', $collections)) {
            $this->info('Migrando veiculos...');
            Veiculo::chunk(200, function ($items) {
                foreach ($items as $v) {
                    $this->client->setDocument('veiculos', (string)$v->id, $v->toArray());
                }
            });
        }

        if (in_array('locacoes', $collections)) {
            $this->info('Migrando locacoes...');
            Locacao::with(['veiculo', 'cliente', 'user'])->chunk(200, function ($rows) {
                foreach ($rows as $l) {
                    $data = $l->toArray();
                    // datas
                    $data['data_inicio'] = $l->data_inicio?->toDateString();
                    $data['data_fim'] = $l->data_fim?->toDateString();
                    // manter ids e, se quiser, referências como string
                    $data['veiculo_id'] = $l->veiculo_id;
                    $data['cliente_id'] = $l->cliente_id;
                    $data['usuario_id'] = $l->usuario_id;
                    $this->client->setDocument('locacoes', (string)$l->id, $data);
                }
            });
        }

        if (in_array('financeiro', $collections)) {
            $this->info('Migrando financeiro...');
            Financeiro::chunk(50, function ($rows) {
                foreach ($rows as $r) {
                    $this->client->setDocument('financeiro', (string)$r->id, $r->toArray());
                }
            });
        }

        if (in_array('users', $collections)) {
            $this->info('Migrando users...');
            User::chunk(100, function ($users) {
                foreach ($users as $u) {
                    $data = $u->toArray();
                    // cuidado com dados sensíveis (mantemos hash por enquanto)
                    $this->client->setDocument('users', (string)$u->id, $data);
                }
            });
        }

        $this->info('Migração via REST concluída.');
    }
}
