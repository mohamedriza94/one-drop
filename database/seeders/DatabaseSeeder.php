<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::factory()->create([
            'no' => '897549650',
            'nic' => '789564123v',
            'fullname' => 'Jack Dorsey',
            'address' => '3D Lady Mcallums Drive',
            'telephone' => '0754896574',
            'photo' => '-',
            'dateofbirth' => '01.01.1999',
            'gender' => 'male',
            'email' => 'jack@gmail.com',
            'role' => 'admin',
            'status' => 'active',
        ]);
    }
}