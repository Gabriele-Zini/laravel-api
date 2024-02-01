<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker)
    {
        $technologies = ['laravel', 'php', 'javascript', 'react', 'vue', 'angular', 'mongoDB', 'c#', 'adonisjs', 'node.js', 'express', 'c++',];

        foreach ($technologies as $technology) {
            $newTechnology=new Technology();
            $newTechnology->technology_name=$technology;
            $newTechnology->hex_color=$faker->hexColor();
            $newTechnology->slug=Str::slug($newTechnology->technology_name);
            $newTechnology->save();
        }
    }
}
