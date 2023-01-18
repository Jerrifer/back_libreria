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

        $material->name_material = "material 1";
        $material->document = "1674074737_Lineamientos y Reglamento de Competencia WorldSkills Colombia 2019-2022.pdf";
        $material->type_material_id = 1;
        $material->editorial_id = 1;


        $material->save();
    }
}
