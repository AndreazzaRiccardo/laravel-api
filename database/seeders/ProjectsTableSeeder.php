<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 24; $i++) { 
            $project = new Project();
            $project->name = $faker->unique()->mimeType();
            $project->description = $faker->text(200);
            $project->link = $faker->url();
            $project->type_id = Type::inRandomOrder()->first()->id;
            $project->user_id = 1;
            $project->save();
            $project->technologies()->attach([$faker->numberBetween(1, 5)]);
        }
    }
}
