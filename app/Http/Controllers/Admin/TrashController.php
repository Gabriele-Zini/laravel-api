<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;

class TrashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::onlyTrashed()->get();
        $types = Type::onlyTrashed()->get();
        return view('admin.trash.index', compact('projects', 'types'));
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        $project = Project::onlyTrashed()->find($id);
        $type = Type::onlyTrashed()->find($id);
        if ($project) {
            $project->restore();
        }

        if ($type) {
            $type->restore();
        }
        return redirect(route('admin.trash.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $type = Type::onlyTrashed()->find($id);
        if ($type) {
            $type->forceDelete();
        }

        $project = Project::onlyTrashed()->find($id);
        if ($project) {
            $project->forceDelete();
        }
        return redirect(route('admin.trash.index'));
    }
}
