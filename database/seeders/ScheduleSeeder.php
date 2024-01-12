<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ScheduleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('schedules')->insert([
                'subject' => 'tranning PHP',
				'teacher' => 'Nguyen Van a',
				'frametime'    => '0',
				'starttime'    => 13.5,
				'endtime'      => 17.5,
				'start_date'    => '2023-06-01',
				'end_date'      => '2024-07-06',
				'class_name'   => '11',
				'note'         => 'Học chiều 2, 4, 6',
				'created_at'   => date('Y-m-d H:i:s'),
				'updated_at'   => date('Y-m-d H:i:s')
        ]);

        DB::table('schedules')->insert([
                'subject' => 'tranning Python',
				'teacher' => 'Nguyen Van B',
				'frametime'    => '0',
				'starttime'    => 07.5,
				'endtime'      => 10.5,
				'start_date'    => '2023-06-01',
				'end_date'      => '2024-07-06',
				'class_name'   => '11',
				'note'         => 'Học chiều 3, 5, 7',
				'created_at'   => date('Y-m-d H:i:s'),
				'updated_at'   => date('Y-m-d H:i:s')
        ]);
    }
}
