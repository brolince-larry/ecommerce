<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        user::updateOrCreate([
         'name'=>'admin',
         'email'=>'admin@gmail.com',
         'password'=>Hash::make(12345678),
         'role'=>0,
         
        ]);
    }
}
