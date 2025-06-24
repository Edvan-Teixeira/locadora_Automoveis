<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use Faker\Factory as Faker;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('pt_BR');

        for ($i = 0; $i < 10; $i++) {
            Cliente::create([
                'nome'            => $faker->name,
                'email'           => $faker->unique()->safeEmail,
                'cpf'             => $faker->unique()->cpf(false),
                'rg'              => $faker->unique()->rg(false),
                'data_nascimento' => $faker->date('Y-m-d', '-18 years'),
                'genero'          => $faker->randomElement(['M', 'F']),
                'cnh'             => $faker->unique()->numerify('###########'),
                'telefone'        => $faker->phoneNumber,
                'celular'         => $faker->phoneNumber,
                'logradouro'      => $faker->streetName,
                'numero'          => $faker->buildingNumber,
                'bairro'          => $faker->citySuffix,
                'cidade'          => $faker->city,
                'estado'          => $faker->stateAbbr,
                'cep'             => $faker->postcode,
            ]);
        }
    }
}
