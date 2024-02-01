<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'FrontEnd',
                'description' => 'The layer above the back end is the front end and it includes all software or hardware that is part of a user interface. Human or digital users interact directly with various aspects of the front end of a program, including user-entered data, buttons, programs, websites and other features.'
            ],
            [
                'name' => 'BackEnd',
                'description' => 'Backend projects are applications or websites you create to prove your web development skills. Here, you can show your ability to work with different types of frameworks and code to create a functioning web application.'
            ],
            [
                'name' => 'FullStack',
                'description' => 'Full stack development is the process of designing, creating, testing, and deploying a complete web application from start to finish. It involves working with various technologies and tools, including front-end web development, back-end web development, and database development.'
            ]
        ];

        foreach ($types as $type) {
            $new_type = new Type();
            $new_type->name = $type['name'];
            $new_type->description = $type['description'];
            $new_type->save();
        }
    }
}
