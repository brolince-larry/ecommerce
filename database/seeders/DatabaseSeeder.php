<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'customer',
            'email' => 'customer.com',
            'password'=> '12345678',
        ]);
       
       $this->call(AdminSeeder::class);
       $this->call(BranchSeeder::class);
    }
}
