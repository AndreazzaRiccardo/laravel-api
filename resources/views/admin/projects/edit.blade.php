@extends('layouts.admin')

@section('admin_page_name')
    EditProject
@endsection

@section('content')
    <div class="container mt-4">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1>EDIT YOUR PROJECT</h1>
                        {{-- Back Button --}}
                        <a class="btn btn-primary"
                            href="{{ route('admin.projects.show', ['project' => $project->slug]) }}">BACK</a>
                    </div>
                    <div class="card-body">

                        {{-- Edit Form --}}
                        <form enctype="multipart/form-data"
                            action="{{ route('admin.projects.update', ['project' => $project->slug]) }}" method="POST">
                            <button type="submit" disabled style="display:none" aria-hidden="true"></button>
                            @csrf
                            @method('PUT')

                            <div class="mb-3 has-validation">
                                <label for="name" class="form-label fw-bold">Project Name</label>
                                <input type="text" class="@error('name') is-invalid @enderror form-control"
                                    id="name" placeholder="Insert name" name="name" required
                                    value="{{ old('name', $project->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 has-validation">
                                <label for="link" class="form-label fw-bold">Project Link</label>
                                <input type="text" class="@error('link') is-invalid @enderror form-control"
                                    id="link" placeholder="Insert link" name="link" required
                                    value="{{ old('link', $project->link) }}">
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 has-validation">
                                <label for="description" class="form-label fw-bold">Description</label>
                                <textarea class="@error('description') is-invalid @enderror form-control" id="description" rows="7"
                                    name="description">{{ old('description', $project->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">

                                <div class="mb-3 w-25">
                                    <label class="fw-bold" for="types">Type</label>
                                    <select class="mt-2 form-select @error('type_id') is-invalid @enderror" name="type_id"
                                        id="types">
                                        <option @selected(!old('type_id', $project->type_id)) value=""></option>
                                        @foreach ($types as $type)
                                            <option @selected(old('type_id', $project->type_id) == $type->id) value="{{ $type->id }}">
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 w-75 d-flex flex-column align-items-center">
                                    <p class="fw-bold">Select Technologies</p>
                                    <div class="d-flex">
                                        @foreach ($technologies as $technology)
                                            <div class="form-check">
                                                <input @checked($errors->any() ? in_array($technology->id, old('technologies', [])) : $project->technologies->contains($technology)) name="technologies[]"
                                                    value="{{ $technology->id }}" type="checkbox"
                                                    id="technology-{{ $technology->id }}">
                                                <label for="technology-{{ $technology->id }}">
                                                    {{ $technology->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('technologies')
                                        <div class="d-block invalid-feedback text-center">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="mb-3">
                                <label for="cover_image"
                                    class="form-label @error('cover_image') is-invalid @enderror fw-bold">Image</label>
                                <input type="file" class="form-control" id="cover_image" name="cover_image">
                                @error('cover_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <img id="preview-image"
                                    src="{{ old('cover_image', asset('storage/' . $project->cover_image)) }}"
                                    alt="" style="max-width: 300px">
                            </div>

                            <div>
                                <a class="btn btn-secondary"
                                    href="{{ route('admin.projects.edit', ['project' => $project->slug]) }}">RESET</a>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#modal-edit">SAVE</button>
                            </div>

                            {{-- Editing Modal --}}
                            @include('partials.modal_edit')
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    @vite(['resources/js/preview.js'])
@endsection
