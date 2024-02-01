@extends('layouts.admin')

@section('admin_page_name')
    TypeDetails
@endsection

@section('content')
    {{-- Edit Message Success --}}
    @if (Session::has('message'))
        <div class="container text-center mt-3">
            <p class="alert alert-success fw-bold">
                {{ strtoupper(Session::get('message')) }}
            </p>
        </div>
    @endif

    {{-- Type Details --}}
    <div class="container fs-5">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>{{ $type->name }}</h2>
            </div>
            {{-- Back Button --}}
            <a href="{{ route('admin.types.index') }}" class="btn btn-primary float-end">BACK</a>
        </div>

        @if ($type->description)
            <hr>
            <div class="mt-4">
                <strong>Description:</strong>
                {{ $type->description }}
            </div>
        @endif

        <hr>
        <div>
            <a class="btn btn-warning mt-4 px-5" href="{{ route('admin.types.edit', ['type' => $type->slug]) }}">EDIT</a>
        </div>
    </div>
@endsection
