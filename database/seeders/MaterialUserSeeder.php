<?php

namespace Database\Seeders;

use App\Models\MaterialUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materialUser = new MaterialUser();

        $materialUser->material_id = 1;
        $materialUser->user_id = 1;

        $materialUser->save();
    }
}
