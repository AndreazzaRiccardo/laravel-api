@extends('layouts.admin')

@section('admin_page_name')
    TypesPage
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

    {{-- Types Table --}}
    <div class="container">

        @if (count($types) > 0)
            <h1>TYPES LIST</h1>
            <div class="text-end my-4">
                {{-- Add Type Button --}}
                <a class="btn btn-primary" href="{{ route('admin.types.create') }}">ADD NEW TYPE</a>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th style="width: 200px" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                        <tr>
                            <th class="opacity-75" scope="row">{{ $type->id }}</th>
                            <td class="opacity-75">{{ $type->name }}</td>
                            <td class="opacity-75">{{ $type->slug }}</td>
                            <td class="d-flex justify-content-around">
                                <a class="btn btn-success"
                                    href="{{ route('admin.types.show', ['type' => $type->slug]) }}">DETAILS</a>
                                <form action="{{ route('admin.types.destroy', ['type' => $type->slug]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button data-title="{{ $type->name }}" class="btn btn-danger delete-btn"
                                        type="submit" data-bs-toggle="modal" data-bs-target="#modal-delete">DELETE</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                <div class="pagination">
                    {{ $types->render() }}
                </div>
            </div>
        @else
            <div class="d-flex flex-column align-items-center mb-4">
                <h2>THERE ARE NO TYPES TO VIEW</h2>
                <a class="btn btn-primary my-4" href="{{ route('admin.types.create') }}">ADD NEW TYPE</a>
            </div>
        @endif

    </div>

    {{-- Deleted Modal --}}
    @include('partials.modal_delete')
@endsection
