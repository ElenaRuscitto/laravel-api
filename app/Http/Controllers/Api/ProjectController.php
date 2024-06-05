<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
   public function index() {
    $projects = Project::with('type', 'technologies')->paginate(12);

    return response()->json($projects);
   }


   public function getTypes() {
    $types = Type::all();

    return response()->json($types);
   }


   public function getTechnologies() {
    $technologies = Technology::all();

    return response()->json($technologies);
   }

//    per immagine in dettaglio guest
   public function getProjectBySlug($slug) {
    $project = Project::where('slug', $slug)->with('type', 'technologies')->first();

    if($project) {
        $success=true;
        if($project->image) {
            $project->image=asset('storage/'. $project->image);
        }else {
            $project->image=asset('storage/uploads/no-image.png');
            $project->original_image='no-image';
        }

    } else {
        $success=false;
    }
    return response()->json(compact('project', 'success'));
   }

    //    per aprire lista progetti cliccando su Tipo in guest
    public function getProjectsByType($slug) {
        $type = Type::where('slug', $slug)->with('projects')->first();

        return response()->json($type);
    }

      //    per aprire lista progetti cliccando su Tecnologie in guest
      public function getProjectsByTechnology($slug) {
        $technology = Technology::where('slug', $slug)->with('projects')->first();

        return response()->json($technology);
    }
}
