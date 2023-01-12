<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();

        $user->name ="Elon";
        $user->lastname ="Musk";
        $user->phone_number ="1234567890";
        $user->email ="lider@example.com";
        $user->password ="12345678";

        $user->save();
    }
}
