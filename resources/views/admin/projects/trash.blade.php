@extends('layouts.admin')

@section('admin_page_name')
    Trash
@endsection

@section('content')

    {{-- Restore Message Success --}}
    @if (session('message'))
        <div class="container text-center">
            <p class="alert alert-success fw-bold">
                {{ strtoupper(session('message')) }}
            </p>
        </div>
    @endif

    {{-- Def Delete Message --}}
    @if (session('def_del_mess'))
        <div class="container text-center">
            <p class="alert alert-danger fw-bold">
                {{ strtoupper(session('def_del_mess')) }}
            </p>
        </div>
    @endif

    {{-- Trash Table --}}
    <div class="container">

        @if (count($projects) > 0)
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>PROJECTS TRASH</h1>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-primary float-end">BACK</a>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Link</th>
                        <th style="width: 200px" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <th class="opacity-75" scope="row">{{ $project->id }}</th>
                            <td class="opacity-75">{{ $project->name }}</td>
                            <td class="text-truncate opacity-75" style="max-width: 300px;">{{ $project->link }}</td>
                            <td class="d-flex justify-content-around">
                                <form action="{{ route('admin.projects.restore', ['project' => $project->slug]) }}"
                                    method="POST">
                                    @csrf
                                    <button class="btn btn-success" type="submit">RESTORE</button>
                                </form>

                                <form action="{{ route('admin.projects.def_destroy', ['project' => $project->slug]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger def-delete-btn" type="submit" data-bs-toggle="modal"
                                        data-bs-target="#modal-def-delete">DELETE</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Restore All Button --}}
            @if ($projects->count() != 0)
                <form action="{{ route('admin.projects.restore_all') }}" method="POST">
                    @csrf
                    <button class="btn btn-primary" type="submit">RESTORE ALL</button>
                </form>
            @endif
            {{-- Pagination Section --}}
            <div class="pagination">
                {{ $projects->render() }}
            </div>
        @else
            <div class="d-flex flex-column align-items-center mb-4">
                <h1 class="text-center mb-4">YOUR TRASH IS EMPTY</h1>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-primary float-end">BACK</a>
            </div>
        @endif

        {{-- Deleted Modal --}}
        @include('partials.modal_def_delete')
    </div>
@endsection
