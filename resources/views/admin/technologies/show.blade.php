@extends('layouts.admin')

@section('admin_page_name')
    TechnologyDetails
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

    {{-- Technology Details --}}
    <div class="container fs-5">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>{{ $technology->name }}</h2>
            </div>
            {{-- Back Button --}}
            <a href="{{ route('admin.technologies.index') }}" class="btn btn-primary float-end">BACK</a>
        </div>

        <hr>
        @if ($technology->description)
            <div class="mt-4">
                <strong>Description:</strong>
                {{ $technology->description }}
            </div>
        @endif
        <div class="mt-4 d-flex align-items-center gap-2">
            <strong>Color:</strong>
            <span class="rounded-2" id="show-color" style="background-color: {{ $technology->hex_color }}"></span><span>{{ $technology->hex_color }}</span>
        </div>

        <hr>
        <div>
            <a class="btn btn-warning mt-4 px-5"
                href="{{ route('admin.technologies.edit', ['technology' => $technology->id]) }}">EDIT</a>
        </div>
    </div>
@endsection
