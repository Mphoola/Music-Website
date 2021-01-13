<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Gospel',
            'slug' => 'Gospel',
        ]);
        Category::create([
            'name' => 'DanceHall',
            'slug' => 'DanceHall',
        ]);
        Category::create([
            'name' => 'Raggue',
            'slug' => 'Raggue',
        ]);
        Category::create([
            'name' => 'Pop',
            'slug' => 'Pop',
        ]);
        Category::create([
            'name' => 'RnB',
            'slug' => 'RnB',
        ]);
        Category::create([
            'name' => 'Accapella',
            'slug' => 'Accapella',
        ]);
        Category::create([
            'name' => 'Pasada',
            'slug' => 'Pasada',
        ]);
        Category::create([
            'name' => 'Local',
            'slug' => 'Local',
        ]);
        Category::create([
            'name' => 'Rock',
            'slug' => 'Rock',
        ]);
       
    }
}
