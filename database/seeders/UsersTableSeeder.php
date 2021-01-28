<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Bright Office',
            'email'=>'admin@bright.ams',
            'password'=>Hash::make('admin@bright123'),
            'address'=>'Milanchok, Butwal',
            'number'=>'071000000',
            'role_id'=>1
        ]);
    }
}
