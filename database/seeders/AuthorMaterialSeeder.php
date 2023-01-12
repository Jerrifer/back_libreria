<?php

namespace Database\Seeders;

use App\Models\AuthorMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authorMaterial = new AuthorMaterial();

        $authorMaterial->author_id = 1;
        $authorMaterial->material_id = 1;

        $authorMaterial->save();
    }
}
