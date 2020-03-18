<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$fwHSsL2yfNx0vGVvjL6RBOqohXHPlCy4/Gw4rsX1h1ilNZ4CgUjou',
                'remember_token' => null,
            ],
        ];

        User::insert($users);

    }
}
