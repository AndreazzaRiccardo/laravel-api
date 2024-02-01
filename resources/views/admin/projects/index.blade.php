@extends('layouts.admin')

@section('admin_page_name')
    MyProjectsPage
@endsection

@section('content')

    {{-- Delete and Restore Message Success --}}
    @if (session('message'))
        <div class="container text-center">
            <p class="alert alert-danger fw-bold">
                {{ strtoupper(session('message')) }}
            </p>
        </div>
    @elseif (session('trash_message'))
        <div class="container text-center">
            <p class="alert alert-success fw-bold">
                {{ strtoupper(session('trash_message')) }}
            </p>
        </div>
    @endif

    {{-- Projects Table --}}
    <div class="container">

        @if (count($projects) > 0)
            <h1>MY PROJECTS LIST</h1>
            <div class="text-end mt-2 mb-4">
                {{-- Add Project Button --}}
                <a class="btn btn-primary" href="{{ route('admin.projects.create') }}">ADD NEW PROJECT</a>
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
                            <td class="opacity-75 text-truncate" style="max-width: 300px;"><a
                                    href="{{ $project->link }}">{{ $project->link }}</a></td>
                            <td class="d-flex justify-content-around">
                                <a class="btn btn-success"
                                    href="{{ route('admin.projects.show', ['project' => $project->slug]) }}">DETAILS</a>
                                <form action="{{ route('admin.projects.destroy', ['project' => $project->slug]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button data-title="{{ $project->name }}" class="btn btn-danger delete-btn"
                                        type="submit" data-bs-toggle="modal" data-bs-target="#modal-delete"><i
                                            class="fa-solid fa-trash-can-arrow-up"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex w-50">
                    <div class="pagination me-5">
                        {{ $projects->render() }}
                    </div>
                    <div>
                        <form action="{{ route('admin.projects.index') }}" method="GET"
                            class="d-flex align-items-center w-25">
                            @csrf
                            <label for="for_page">Paginate</label>
                            <select class="form-select mx-3" style="min-width:150px" name="for_page" id="for_page">
                                <option @selected($paginate == 12) value="12">12</option>
                                <option @selected($paginate == 24) value="24">24</option>
                                <option @selected($paginate == 36) value="36">36</option>
                            </select>
                            <button class="btn btn-primary" type="submit">PAGINATE</button>
                        </form>
                    </div>
                </div>

                <a class="btn btn-secondary" href="{{ route('admin.projects.trash') }}"><i
                        class="fa-solid fa-trash"></i></a>
            </div>
        @else
            <div class="d-flex flex-column align-items-center mb-4">
                <h2>THERE ARE NO PROJECTS TO VIEW</h2>
                <a class="btn btn-primary my-4" href="{{ route('admin.projects.create') }}">ADD NEW PROJECT</a>
                <a class="btn btn-secondary" href="{{ route('admin.projects.trash') }}"><i
                        class="fa-solid fa-trash"></i></a>
            </div>
        @endif

    </div>

    {{-- Deleted Modal --}}
    @include('partials.modal_delete')
@endsection
