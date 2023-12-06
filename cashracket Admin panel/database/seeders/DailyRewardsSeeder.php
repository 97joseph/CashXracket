<?php

namespace Database\Seeders;

use App\Models\Api\DailyRewards;
use Illuminate\Database\Seeder;

class DailyRewardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daily_rewards = array(
            array('user_id' => 2, 'description' => 'Daily Reward', 'amount' => 100, 'gain_status' => 'Gain', 'status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('user_id' => 3, 'description' => 'Daily Reward', 'amount' => 100, 'gain_status' => 'Gain', 'status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('user_id' => 4, 'description' => 'Daily Reward', 'amount' => 100, 'gain_status' => 'Gain', 'status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('user_id' => 5, 'description' => 'Daily Reward', 'amount' => 100, 'gain_status' => 'Gain', 'status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('user_id' => 6, 'description' => 'Daily Reward', 'amount' => 100, 'gain_status' => 'Gain', 'status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('user_id' => 7, 'description' => 'Daily Reward', 'amount' => 100, 'gain_status' => 'Gain', 'status' => 1, 'created_at' => now(), 'updated_at' => now()),
        );

        DailyRewards::insert($daily_rewards);
    }
}