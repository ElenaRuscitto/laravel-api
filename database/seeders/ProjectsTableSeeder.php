<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Faker\Generator as Faker;
use App\Functions\Helper as Help;
use Illuminate\Support\Str;
use App\Models\Type;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     public function run(Faker $faker): void
     {
         for ($i=0; $i < 60 ; $i++) {
             $new_project = new Project();

             $new_project->title = $faker->word(9, true);
             $new_project->slug = Help::generateSlug($new_project->title, Project::class);
             $new_project->link =$faker->url();
            //  $new_project->type =$faker->word(9, true);
             $new_project->description =$faker->paragraph(3, true);


            // associo randomicamente un ID della categoria al post
            $new_project->type_id = Type::inRandomOrder()->first()->id;
             $new_project->save();
         }
     }
}
