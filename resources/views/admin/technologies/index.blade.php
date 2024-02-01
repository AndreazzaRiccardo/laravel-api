@extends('layouts.admin')

@section('admin_page_name')
    TechnologiesPage
@endsection

@section('content')

    {{-- Delete Message Success --}}
    @if (session('message'))
        <div class="container text-center">
            <p class="alert alert-danger fw-bold">
                {{ strtoupper(session('message')) }}
            </p>
        </div>
    @endif

    {{-- Technologies Table --}}
    <div class="container">

        @if (count($technologies) > 0)
            <h1>TECHNOLOGIES LIST</h1>
            <div class="text-end my-4">
                {{-- Add Type Button --}}
                <a class="btn btn-primary" href="{{ route('admin.technologies.create') }}">ADD NEW TECHNOLOGY</a>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Color</th>
                        <th style="width: 200px" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($technologies as $technology)
                        <tr>
                            <th class="opacity-75" scope="row">{{ $technology->id }}</th>
                            <td class="opacity-75">{{ $technology->name }}</td>
                            <td class="opacity-75"><span id="preview-color" class="me-2"
                                    style="background-color:{{ $technology->hex_color }}"></span>{{ $technology->hex_color }}
                            </td>
                            <td class="d-flex justify-content-around">
                                <a class="btn btn-success"
                                    href="{{ route('admin.technologies.show', ['technology' => $technology->id]) }}">DETAILS</a>
                                <form action="{{ route('admin.technologies.destroy', ['technology' => $technology->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button data-title="{{ $technology->name }}" class="btn btn-danger delete-btn"
                                        type="submit" data-bs-toggle="modal" data-bs-target="#modal-delete">DELETE</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                <div class="pagination">
                    {{ $technologies->render() }}
                </div>
            </div>
        @else
            <div class="d-flex flex-column align-items-center mb-4">
                <h2>THERE ARE NO TECHNOLOGIES TO VIEW</h2>
                <a class="btn btn-primary my-4" href="{{ route('admin.projects.create') }}">ADD NEW TECHNOLOGY</a>
            </div>
        @endif

    </div>

    {{-- Deleted Modal --}}
    @include('partials.modal_delete')
@endsection
