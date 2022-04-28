<?php

namespace Database\Seeders\Testing;

use App\Http\Models\Developers\LevelsModel;
use Illuminate\Database\Seeder;

class DeveloperLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!LevelsModel::query()->where('id', '=', 1)->first()) {
            LevelsModel::query()->create([
                'id' => 1,
                'nivel' => 'Junior',
            ]);
        }

        if (!LevelsModel::query()->where('id', '=', 2)->first()) {
            LevelsModel::query()->create([
                'id' => 2,
                'nivel' => 'Pleno',
            ]);
        }

        if (!LevelsModel::query()->where('id', '=', 3)->first()) {
            LevelsModel::query()->create([
                'id' => 3,
                'nivel' => 'Senior',
            ]);
        }
    }
}
