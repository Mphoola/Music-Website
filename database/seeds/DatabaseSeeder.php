<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsTableSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BeatsSeeder::class);
        $this->call(MusicsSeeder::class);
        $this->call(VideosSeeder::class);
     
        $this->call(CommentsSeeder::class);

    }
}
 