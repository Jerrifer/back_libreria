<?php

namespace Database\Seeders;

use App\Models\EducationLevelMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationLevelMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $educationLevelMaterial = new EducationLevelMaterial();

        $educationLevelMaterial->educaction_level_id = 1;
        $educationLevelMaterial->material_id = 1;

        $educationLevelMaterial->save();
    }
}
