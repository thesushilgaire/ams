<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Attendance;
use App\Models\User;
use DB;

class AttendanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $data = [];
        $users = collect(User::pluck('id'));
        $status = collect(['Check In','Check Out','Late Check In','Early Check Out']);

        for($i = 1;$i<100;$i++){
            $data[] = [
                'uid' => $users->random(),
                'user_id'=>$users->random(),
                'state'=>0,
                'time_ad'=>$faker->dateTimeBetween($startDate = '-1 years', $endDate = '+1 years', $timezone =  'Asia/Kathmandu'),
                'time_bs'=>$faker->dateTimeBetween($startDate = '-1 years', $endDate = '+1 years', $timezone =  'Asia/Kathmandu'),
                'created_at'=>now()->toDateTimeString(),
                'updated_at'=>now()->toDateTimeString(),
                'status'=>$status->random()
            ];
        }

            Attendance::insert($data);

    }
}
