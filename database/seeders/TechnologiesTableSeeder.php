<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $technologies = [
            [
                'name' => 'Javascript Plain',
                'description' => 'JavaScript is a scripting language that enables you to create dynamically updating content, control multimedia, animate images, and pretty much everything else.',
            ],
            [
                'name' => 'HTML/Css',
                'description' => 'HTML and CSS are scripting languages used to create a web page and web applications. HTML provides web page structure, whereas CSS is mainly used to control web page styling.'
            ],
            [
                'name' => 'PHP Plain',
                'description' => 'PHP (Hypertext Processor) is a general-purpose scripting language and interpreter that is freely available and widely used for web development. The language is used primarily for server-side scripting, although it can also be used for command-line scripting and, to a limited degree, desktop applications.'
            ],
            [
                'name' => 'Vue JS',
                'description' => 'Vuejs is a JavaScript framework for building user interfaces. It builds on top of standard HTML, CSS, and JavaScript and provides a declarative and component-based programming model that helps you efficiently develop user interfaces, be they simple or complex.'
            ],
            [
                'name' => 'Laravel',
                'description' => 'Laravel is a free and open-source PHP web framework, created by Taylor Otwell and intended for the development of web applications following the model–view–controller (MVC) architectural pattern and based on Symfony.'
            ]

        ];

        foreach ($technologies as $technology) {
            $new_technology = new Technology();
            $new_technology->name = $technology['name'];
            $new_technology->description = $technology['description'];
            $new_technology->hex_color = $faker->hexColor();
            $new_technology->save();
        }
    }
}
