<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Bawaslu admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin1234'),
        ]);
        $admin->assignRole('admin');

        $operator = User::create([
            'name' => 'Bawaslu operator',
            'email' => 'operator@gmail.com',
            'password' => bcrypt('operator1234'),
        ]);
        $operator->assignRole('operator');

        $peminjam = User::create([
            'name' => 'Peminjam',
            'email' => 'peminjam@gmail.com',
            'password' => bcrypt('peminjam1234'),
        ]);
        $peminjam->assignRole('peminjam');
    }
}
