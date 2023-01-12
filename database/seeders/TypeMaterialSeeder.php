<?php

namespace Database\Seeders;

use App\Models\TypeMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeMaterial = new TypeMaterial();

        $typeMaterial->name ="tipo material 1";

        $typeMaterial->save();
    }
}
