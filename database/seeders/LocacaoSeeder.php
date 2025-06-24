<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Locacao;
use App\Models\Cliente;
use App\Models\Financeiro;
use App\Models\Veiculo;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;

class LocacaoSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('pt_BR');
        $clientes = Cliente::all();
        $veiculos = Veiculo::all();
        $usuarios = User::all();

        if ($clientes->count() < 1 || $veiculos->count() < 1 || $usuarios->count() < 1) {
            $this->command->warn('Você precisa de clientes, veículos e usuários cadastrados para popular locações.');
            return;
        }

        $financeiro = Financeiro::first();
        if (!$financeiro) {
            $financeiro = Financeiro::create(['saldo_total' => 0]);
        }

        for ($i = 0; $i < 10; $i++) {
            $dataInicio = Carbon::instance($faker->dateTimeBetween('-30 days', 'now'));
            $dias = $faker->numberBetween(1, 10);
            $dataFim = $dataInicio->copy()->addDays($dias);

            $veiculo = $veiculos->random();
            $valorTotal = $dias * $veiculo->valor_diaria;

            Locacao::create([
                'cliente_id'   => $clientes->random()->id,
                'veiculo_id'   => $veiculo->id,
                'usuario_id'   => $usuarios->random()->id,
                'data_inicio'  => $dataInicio->format('Y-m-d'),
                'data_fim'     => $dataFim->format('Y-m-d'),
                'valor_total'  => $valorTotal,
            ]);

            $financeiro->increment('saldo_total', $valorTotal);
        }
    }
}
