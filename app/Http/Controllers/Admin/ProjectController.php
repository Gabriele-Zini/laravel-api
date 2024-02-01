<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 20;
        if ($request->per_page) {
            $perPage = $request->per_page;
        }
        $technologies = Technology::all();
        $projects = Project::where('user_id', '=', Auth::user()->id)->paginate($perPage);
        return view('admin.projects.index', compact('projects', 'technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();
        $project = new Project();
        $project->fill($form_data);
        if ($request->hasFile('cover_image')) {
            $image_path = Storage::put('project_images', $request->cover_image);
            $project->cover_image = $image_path;
        }

        $project->user_id = Auth::user()->id;
        $project->save();

        if ($request->has('technologies')) {

            $project->technologies()->attach($request->technologies);
        }
        return redirect()->route('admin.projects.show', ['project' => $project->slug]);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Project $project)
    {
        $technologies = Technology::all();
        $this->checkUser($project);
        return view('admin.projects.show', compact('project', 'technologies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $this->checkUser($project);
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->checkUser($project);
        $form_data = $request->validated();
        // dd($request->all());
        if ($request->hasFile('cover_image')) {

            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }


            $image_path = Storage::put('project_images', $request->cover_image);
            $form_data['cover_image'] = $image_path;
        }
        $project->update($form_data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($request->input('technologies', []));
        }
        return redirect()->route('admin.projects.show', ['project' => $project->slug])->with('message', 'you have updated: ' . $project->name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->checkUser($project);
        $project->delete();

        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }

        return redirect(route('admin.projects.index'))->with('message', 'you have deleted: ' . $project->name);
    }

    private function checkUser(Project $project)
    {
        if ($project->user_id !== Auth::user()->id) {
            abort(404);
        }
    }
}
