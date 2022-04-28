<?php

namespace Database\Seeders\Testing;

use App\Http\Models\Developers\DevelopersModel;
use Illuminate\Database\Seeder;

class DevelopersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!DevelopersModel::query()->where('id', '=', 1)->first()) {
            DevelopersModel::query()->create([
                'id' => 1,
                'nivel_id' => 1,
                'nome' => 'Developers Test',
                'sexo' => 'M',
                'data_nascimento' => '1990-01-01',
                'idade' => '32',
                'hobby' => 'Gamer',
            ]);
        }
    }
}
