<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Promise',
            'email' => 'promisemphoola2@gmail.com',
            'password' => Hash::make('1234567890')
        ]);
        Admin::create([
            'name' => 'Robert',
            'email' => 'rob@gmail.com',
            'password' => Hash::make('1234567890')
        ]);
        Admin::create([
            'name' => 'Fransic',
            'email' => 'fbu@gmail.com',
            'password' => Hash::make('1234567890')
        ]);
    }
}
