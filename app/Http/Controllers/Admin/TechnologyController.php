<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use App\Models\Type;
use App\Functions\Helper as Help;
use App\Http\Requests\TechnologyRequest;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tecnologies = Technology::orderByDesc('id')->get();
        $types = Type::orderByDesc('id')->get();

        return view('admin.technologies.index', compact('tecnologies', 'types'));
    }


    public function technologyProjects(Technology $technology){
        $projects = $technology->projects;
        return view('admin.technologies.technology-projects',compact('projects','technology'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */



    //  AGGIUNTA DI NUOVA TECNOLOGIA
    public function store(TechnologyRequest $request)
    {
        $form_data = $request->all();

        $exists = Technology::where('name', $form_data['name'])->first();

        if ($exists) {

            return redirect()->route('admin.technologies.index')->with('error', 'La Tecnologia ' . $form_data['name'] . ' é già presente');

        } else {
            $form_data['slug'] = Help::generateSlug($form_data['name'], Technology::class);
            $technology = new Technology;
            $technology->fill($form_data);

            $technology->save();

            return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia ' . $technology->name . ' aggiunta con successo');


        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */



    //  MODIFICA DELLA TECNOLOGIA
    public function update(TechnologyRequest $request, Technology $technology)
    {
        $form_data = $request->all();

        $exists = Technology::where('name', $form_data['name'])->first();

        if ($exists) {
            return redirect()->route('admin.technologies.index')->with('error', 'La Tecnologia ' . $form_data['name'] . ' é già presente');
        } else {
            if ($form_data['name'] === $technology->name) {
                $form_data['slug'] = $technology->slug;
            } else {
                $form_data['slug'] = Help::generateSlug($form_data['name'], Type::class);
            }

            $technology->update($form_data);

            return redirect()->route('admin.technologies.index')->with('success', 'La Tecnologia ' . $technology->name . 'è stata modificata con successo');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia ' . $technology->name . ' eliminata con successo');
    }
}
