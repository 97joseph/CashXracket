<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class Quizzes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quizzes = array(
            array('category_id' => 1, 'name' => 'Glove', 'image' => 'back-end/img/Quiz_image/16779944838266.jpg', 'paid_status' => 0, 'free_or_paid' => null, 'reward_point' => 200, 'retake_point' => 100, 'status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 2, 'name' => 'FIFA', 'image' => 'back-end/img/Quiz_image/16679695771760.jpg', 'paid_status' => 0, 'free_or_paid' => null, 'reward_point' => 1000, 'retake_point' => 200, 'status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 3, 'name' => 'ICC', 'image' => 'back-end/img/Quiz_image/16779935572660.jpg', 'paid_status' => 0, 'free_or_paid' => null, 'reward_point' => 20, 'retake_point' => 20, 'status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 4, 'name' => 'Basket Game', 'image' => 'back-end/img/Quiz_image/16779936226900.jpg', 'paid_status' => 0, 'free_or_paid' => null, 'reward_point' => 10, 'retake_point' => 10, 'status' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 5, 'name' => 'Rider', 'image' => 'back-end/img/Quiz_image/16779937385415.jpg', 'paid_status' => 0, 'free_or_paid' => null, 'reward_point' => 15, 'retake_point' => 15, 'status' => 1, 'created_at' => now(), 'updated_at' => now()),
        );

        Quiz::insert($quizzes);
    }
}