@extends('layouts.admin')

@section('admin_page_name')
    ProjectDetails
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

    {{-- Project Details --}}
    <div class="container fs-5">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="d-flex align-items-center flex-wrap">
                    <h2>{{ $project->name }}</h2>
                    @foreach ($project->technologies as $technology)
                        <div id="badge">
                            <span class="ms-4 badge"
                                style="background-color: {{ $technology->hex_color }}">{{ $technology->name }}</span>
                            <p
                                class="text-light card bg-dark card-body position-absolute w-25 mt-2 d-none badge-description">
                                {{ $technology->description }}</p>
                        </div>
                    @endforeach
                </div>
                <p>{{ $project->slug }}</p>
            </div>
            {{-- Back Button --}}
            <a href="{{ route('admin.projects.index') }}" class="btn btn-primary float-end">BACK</a>
        </div>
        @if ($project->cover_image)
            <div>
                <img style="max-width:600px;" src="{{ asset('storage/' . $project->cover_image) }}" alt="">
            </div>
        @endif
        <hr>
        <div class="mt-4">
            <strong>Link:</strong>
            <a href="">{{ $project->link }}</a>
        </div>

        @if ($project->type)
            <div class="mt-4">
                <strong>Type:</strong>

                <button class="btn border" type="button" data-bs-toggle="collapse" data-bs-target="#description-collaps"
                    aria-expanded="false" aria-controls="description-collaps">
                    {{ $project->type->name }}
                </button>
                @if ($project->type->description)
                    <div class="collapse mt-2" id="description-collaps">
                        <div class="card card-body">
                            {{ $project->type->description }}
                        </div>
                    </div>
                @endif
            </div>
        @endif

        @if ($project->description)
            <div class="mt-4">
                <strong>Description:</strong>
                {{ $project->description }}
            </div>
        @endif
        <div class="mt-4">
            <strong>Upload Date:</strong>
            {{ $project->created_at }}
        </div>
        <hr>
        <div>
            <a class="btn btn-warning mt-4 px-5"
                href="{{ route('admin.projects.edit', ['project' => $project->slug]) }}">EDIT</a>
        </div>
    </div>
@endsection
