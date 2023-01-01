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
            'photo' => 'https://www.mindwebtree.com/wp-content/uploads/2022/06/29592647-40da86ca-875a-11e7-8bc3-941700b0a323.png',
            'dateofbirth' => '01.01.1999',
            'gender' => 'male',
            'email' => 'jack@gmail.com',
            'role' => 'admin',
            'status' => 'active',
        ]);
    }
}