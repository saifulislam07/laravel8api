<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Saiful', 'email' => 'saiful@gmail.com', 'password' => '123456'],
            ['name' => 'Islam', 'email' => 'islam@gmail.com', 'password' => '123456'],
            ['name' => 'Rana', 'email' => 'rana@gmail.com', 'password' => '123456'],
        ];
        User::insert($users);
    }
}
