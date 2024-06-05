<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use App\Models\Project;
use App\Models\Type;
use App\Functions\Helper as Help;
use App\Http\Requests\TechnologyRequest;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function typeProjects() {
        $types = Type::paginate(10);
        return view('admin.type.type-project', compact('types'));
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
    public function store(TechnologyRequest $request)
    {
        $form_data = $request->all();

        $exists = Type::where('name', $form_data['name'])->first();

        if ($exists) {

            return redirect()->route('admin.technologies.index')->with('error', 'Il tipo ' . $form_data['name'] . ' é già presente');

        } else {
            $form_data['slug'] = Help::generateSlug($form_data['name'], Type::class);
            $type = new Type;
            $type->fill($form_data);
            $type->save();

            return redirect()->route('admin.technologies.index')->with('success', 'Tipo ' . $type->name . ' aggiunto con successo');;
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
    public function update(TechnologyRequest $request, Type $type)
    {
        $form_data = $request->all();

        $exists = Type::where('name', $form_data['name'])->first();

        if ($exists) {
            return redirect()->route('admin.technologies.index')->with('error', 'Il tipo ' . $form_data['name'] . ' é già presente');
        } else {
            if ($form_data['name'] === $type->name) {
                $form_data['slug'] = $type->slug;
            } else {
                $form_data['slug'] = Help::generateSlug($form_data['name'], Type::class);
            }

            $type->update($form_data);

            return redirect()->route('admin.technologies.index')->with('success', 'Tipo ' . $type->name . 'è stato modificato con successo');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.technologies.index')->with('success', 'Tipo ' . $type->name . ' eliminato con successo');
    }
}
