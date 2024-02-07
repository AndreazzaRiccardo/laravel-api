<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request) {
        if($request->has('type_id')) {
            $projects = Project::with('type', 'technologies')->where('type_id', $request->type_id)->paginate(12);
        } else {
            $projects = Project::with('type', 'technologies')->paginate(12);
        }
        
        return response()->json([
            'results' => $projects,
            'success' => true
        ]);
    }

    public function showUser() {
        $user = User::where('id', 1)->first();
        return response()->json([
            'results' => $user,
            'success' => true
        ]);
    }

    public function show(string $slug) {
        $project = Project::with('type', 'technologies')->where('slug', $slug)->first();
        if($project) {
            return response()->json([
                'results' => $project,
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Project not found'
            ]);
        }
    }

    public function searchProject($name) {
        $search_projects = Project::with('type', 'technologies')->where('name', 'like', '%'.$name.'%')->get();
        if($search_projects) {
            return response()->json([
                'results' => $search_projects,
                'success' => true
            ]);
        }
    }

    public function types() {
        $types = Type::all();
        return response()->json([
            'results' => $types,
            'success' => true
        ]);
    }
}
