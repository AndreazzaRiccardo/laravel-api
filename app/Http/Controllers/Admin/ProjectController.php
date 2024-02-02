<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = 12;

        if ($request->for_page) {
            $paginate = $request->for_page;
        }

        $projects = Project::where('user_id', Auth::user()->id)->orderBy('name')->paginate($paginate);

        return view('admin.projects.index', compact('projects', 'paginate'));
    }


    /**
     * Displays deleted items.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $projects = Project::where('user_id', Auth::user()->id)->onlyTrashed()->paginate(12);

        return view('admin.projects.trash', compact('projects'));
    }


    /**
     * Restore deleted items.
     * 
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function restore($slug)
    {
        $project = Project::withTrashed()->where('slug', $slug)->first();

        $this->checkUser($project);

        $project->restore();

        if ((Project::onlyTrashed()->count()) === 0) {
            return redirect()->route('admin.projects.index')->with('trash_message', 'All projects has been restored');
        } else {
            return redirect()->back()->with('message', "$project->name has been restored");
        }
    }


    /**
     * Restore all deleted items.
     * 
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function restoreAll()
    {
        $projects = Project::where('user_id', Auth::user()->id)->withTrashed();

        $projects->restore();

        return redirect()->route('admin.projects.index')->with('trash_message', 'All projects has been restored');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $project = new Project();
        $project->user_id = Auth::id();

        if ($request->hasFile('cover_image')) {
            $img_path = Storage::put('projects_images', $request->cover_image);
            $project->cover_image = $img_path;
        }

        $project->fill($request->validated());

        $this->checkUser($project);
      
        $project->save();

        if ($request->has('technologies')) {
            $project->technologies()->attach($request->technologies);
        }

        return redirect()->route('admin.projects.show', ['project' => $project->slug]);
    }


    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $this->checkUser($project);

        return view('admin.projects.show', compact('project'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        $this->checkUser($project);

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProjectRequest $request
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->checkUser($project);

        if ($request->hasFile('cover_image')) {
            if ($project->cover_image) {
                Storage::delete('cover_image');
            }
            $img_path = Storage::put('projects_images', $request->cover_image);
            $project->cover_image = $img_path;
        }

        $project->update($request->validated());

        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->sync([]);
        }

        return redirect()->route('admin.projects.show', ['project' => $project->slug])->with('message', "$project->name has been modified");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->checkUser($project);

        $project->delete();

        return redirect()->back()->with('message', "$project->name was deleted");
    }


    /**
     * Delete the specified resource from trash.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function defDestroy($slug)
    {
        $project = Project::withTrashed()->where('slug', $slug)->first();

        $this->checkUser($project);

        $project->forceDelete();

        return redirect()->back()->with('def_del_mess', "$project->name has been permanently eliminated");
    }


    /**
     * Check currently user
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    private function checkUser(Project $project)
    {
        if (!$project || $project->user_id !== Auth::id()) {
            abort(404);
        }
    }
}
