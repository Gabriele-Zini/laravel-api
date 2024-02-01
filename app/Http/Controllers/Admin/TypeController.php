<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Project;
use App\Http\Requests\UpdateTypeRequest;
use App\Http\Requests\StoreTypeRequest;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        $projects = Project::all();
        return view('admin.types.index', compact('types', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $form_data = $request->validated();
        $type= new Type();
        $type->fill($form_data);
        $type->save();
        return redirect(route('admin.types.show', ['type'=>$type->slug]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        $projects = Project::all();
        return view('admin.types.show', compact('type', 'projects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $form_data = $request->validated();
        $type->update($form_data);
        return redirect(route('admin.types.show', ['type' => $type->slug]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect(route('admin.types.index'))->with('message', 'you have deleted: ' . $type->name);
    }
}
