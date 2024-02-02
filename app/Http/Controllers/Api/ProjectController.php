<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['type', 'technologies', 'user'])->paginate(10);

        if ($projects) {
            return response()->json(
                [
                    'result' => $projects,
                    'success' => true,
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Nessun progetto trovato'
                ]
            );
        }
    }

    public function show(string $slug)
    {
        $project = Project::with(['type', 'technologies', 'user'])->where('slug', $slug)->first();
        if ($project) {

            return response()->json(
                [
                    'result' => $project,
                    'success' => true,
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Il progetto non esiste'
                ]
            );
        }
    }
}
