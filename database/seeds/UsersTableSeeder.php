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
                'password'       => '$2y$10$/mthXJaILjRsHLp4ffHJduZhFD3uYUgbd0tJMAi40V/4Tx/deTvcW',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
