<?php

use App\Song;
use Illuminate\Database\Seeder;

class MusicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Song::class, 120)->create();
    }
}
