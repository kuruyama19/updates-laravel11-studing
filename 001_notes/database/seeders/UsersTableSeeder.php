<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
          [
            [
                'username' => 'admin@teste.com.br',
                'password' => bcrypt('admin123'),
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'admin2@teste.com.br',
                'password' => bcrypt('admin123'),
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'admin3@teste.com.br',
                'password' => bcrypt('admin123'),
                'created_at' => date('Y-m-d H:i:s')
            ],
          ]
        );
    }
}
