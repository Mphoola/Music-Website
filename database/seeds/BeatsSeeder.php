<?php

use App\Beat;
use Illuminate\Database\Seeder;

class BeatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Beat::class, 120)->create();
    }
}
