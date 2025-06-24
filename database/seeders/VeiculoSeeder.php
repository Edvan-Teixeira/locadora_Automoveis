<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Veiculo;
use Faker\Factory as Faker;

class VeiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('pt_BR');

        $marcasModelos = [
            ['marca' => 'Toyota', 'modelo' => 'Corolla'],
            ['marca' => 'Honda', 'modelo' => 'Civic'],
            ['marca' => 'Ford', 'modelo' => 'Ka'],
            ['marca' => 'Chevrolet', 'modelo' => 'Onix'],
            ['marca' => 'Fiat', 'modelo' => 'Argo'],
            ['marca' => 'Volkswagen', 'modelo' => 'Polo'],
            ['marca' => 'Hyundai', 'modelo' => 'HB20'],
            ['marca' => 'Renault', 'modelo' => 'Sandero'],
            ['marca' => 'Nissan', 'modelo' => 'Versa'],
            ['marca' => 'Jeep', 'modelo' => 'Renegade'],
        ];

        foreach ($marcasModelos as $item) {
            Veiculo::create([
                'marca'         => $item['marca'],
                'modelo'        => $item['modelo'],
                'ano'           => $faker->numberBetween(2015, date('Y')),
                'placa'         => strtoupper($faker->bothify('???-####')),
                'cor'           => $faker->safeColorName(),
                'imagem'        => 'imagens/corolla.jpeg',
                'valor_diaria'  => $faker->randomFloat(2, 80, 250),
            ]);
        }
    }
}
