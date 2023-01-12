<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $material = new Material();

        $material->name_material ="material 1";
        $material->type_material_id = 1;
        $material->editorial_id = 1;


        $material->save();
    }
}
