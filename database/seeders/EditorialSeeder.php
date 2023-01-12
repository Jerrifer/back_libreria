<?php

namespace Database\Seeders;

use App\Models\Editorial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EditorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $editorial = new Editorial();

        $editorial->name_editorial ="editorial 1";

        $editorial->save();
    }
}
