<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::paginate(12);

        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTypeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeRequest $request)
    {
        $type = new Type();
        if (!$type) {
            abort(404);
        }

        $type->fill($request->validated());

        $type->save();

        return redirect()->route('admin.types.show', ['type' => $type->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        if (!$type) {
            abort(404);
        }

        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        if (!$type) {
            abort(404);
        }

        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTypeRequest $request
     * @param  Type $type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        if (!$type) {
            abort(404);
        }

        $type->update($request->validated());

        return redirect()->route('admin.types.show', ['type' => $type->slug])->with('message', "$type->name has been modified");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Type $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        if (!$type) {
            abort(404);
        }
        
        $type->delete();

        return redirect()->back()->with('def_del_mess', "$type->name has been permanently eliminated");
    }
}
