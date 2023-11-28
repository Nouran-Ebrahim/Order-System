<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456789'),
            'isAdmin'=>1
        ]);
        User::create([
            'name' => 'Regular User',
            'email' => 'nouran@gmail.com',
            'password' => bcrypt('15021999'),
            'isAdmin'=>0
        ]);
    }
}
