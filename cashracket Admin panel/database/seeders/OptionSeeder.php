<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Option;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = array(
            array('key' => 'spins','value' => '{"entry_fee":"10","position0":"100","position1":"1","position2":"2","position3":"3","position4":"4","position5":"5","position6":"6","position7":"7","position8":"8","position9":"9"}','status' => '1','created_at' => '2023-08-27 10:28:54','updated_at' => '2023-09-03 12:53:26')
          );

        Option::insert($options);
    }
}
