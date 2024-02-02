<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::with('type', 'technologies')->paginate(12);
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
}
