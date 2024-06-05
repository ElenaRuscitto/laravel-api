<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use App\Functions\Helper as Help;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $projects = Project::all();

        if(isset($_GET['toSearch'])){
            $projects = Project::where('title', 'LIKE', '%' . $_GET['toSearch'] . '%')->paginate(10);
        } else {

            $projects = Project::orderByDesc('id')->paginate(15);
        }

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title='Aggiungi un nuovo progetto';
        $route=route('admin.projects.store');
        $project=null;
        $button='Salva';
        $method= 'POST';
        $types = Type::all();
        $technologies = Technology::all();


        return view('admin.projects.create-edit', compact('title','route','project', 'button','method','types', 'technologies'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();

        // verifico l'esistenza della chiave 'image' in $form_data
        if(array_key_exists('image', $form_data)) {
            // salvo immagine nello storage e ottengo il percorso
            $image_path = Storage::put('uploads', $form_data['image']);

            $original_image = $request->file('image')->getClientOriginalName();

            $form_data['image'] = $image_path;
            $form_data['original_image'] = $original_image;

        }

        $exixts = Project::where('title', $form_data['title'])->first();

        // controllo se esiste già il progetto
            if($exixts) {

                return redirect()->route('admin.projects.create-edit')->with('error', 'Progetto già esistente!');
// controllo di successo nell'aggiunta del progetto
            } else {

                $new_project = new Project();
                $form_data['slug'] = Help::generateSlug($form_data['title'], Project::class);

                $new_project->fill($form_data);

                $new_project->save();

                if(array_key_exists('technologies', $form_data)) {
                    $new_project->technologies()->attach($form_data['technologies']);
                }

                return redirect()->route('admin.projects.index')->with('success', 'Progetto aggiunto correttamente!');

            }



    }

    /**
     * Display the specified resource.
     */


    //  DETTAGLIO DEL PROGETTO
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */


    //  MODIFICA PROGETTO
    public function edit(Project $project)
    {
        $title='Modifica Progetto';
        $route=route('admin.projects.update', $project);
        $button='Salva' ;
        $method= 'PUT';
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create-edit', compact('title','route','project', 'button','method','types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data = $request->all();


             // verifico l'esistenza della chiave 'image' in $form_data
            if(array_key_exists('image', $form_data)){
                // salvo l'immagine nello storage e ottengo il percorso
                $image_path = Storage::put('uploads', $form_data['image']);

                // ottengo il nome originale dell'immagine
                $original_image = $request->file('image')->getClientOriginalName();
                $form_data['image']= $image_path;
                $form_data['original_image']= $original_image;

            }

            if($form_data['title'] === $project->title){
            $form_data['slug'] = $project->slug;
            }else{
                $form_data['slug'] = Help::generateSlug($form_data['title'], Project::class) ;
            }

            $project->update($form_data);


        // funzione per MANY TO MANY
        if(array_key_exists('technologies', $form_data)) {
            // aggiorno tutte le relazioni eliminando quelle che eventualmente non ci sono
            $project->technologies()->sync($form_data['technologies']);
        } else {
            // se non sono presenti id dentro i technologies elimino tutte le relazioni con tecnologi
            $project->technologies()->detach();
        }


        return redirect()->route('admin.projects.index',$project)->with('update', 'Il progetto è stato aggiornato');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('deleted', 'Il progetto'. ' ' . $project->title. ' ' .'è stato cancellato con successo!');
    }
}
