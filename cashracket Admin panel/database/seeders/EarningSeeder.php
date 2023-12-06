<?php

namespace Database\Seeders;

use App\Models\Earning;
use Illuminate\Database\Seeder;

class EarningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $earnings = array(
            array('title' => 'Font Awesome', 'type' => 'website', 'url' => 'https://fontawesome.com/', 'price' => 0, 'reward_point' => 100, 'duration' => 10, 'status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('title' => 'Fast Dot Com', 'type' => 'website', 'url' => 'https://fast.com/', 'price' => 0, 'reward_point' => 20, 'duration' => 5, 'status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('title' => 'First Scratch Card', 'type' => 'scratch_card', 'url' => null, 'price' => 10, 'reward_point' => 1000, 'duration' => 0, 'status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('title' => 'Second Scratch Card', 'type' => 'scratch_card', 'url' => null, 'price' => 20, 'reward_point' => 2000, 'duration' => 0, 'status' => 1, 'created_at' => now(), 'updated_at' => now()),
        );

        Earning::insert($earnings);
    }
}