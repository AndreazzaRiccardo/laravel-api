@extends('layouts.admin')

@section('admin_page_name')
    CreateNewProject
@endsection

@section('content')
    <div class="container mt-4">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1>ADD NEW PROJECT</h1>
                        {{-- Back Button --}}
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary float-end">BACK</a>
                    </div>
                    <div class="card-body">

                        {{-- Create Form --}}
                        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                            <button type="submit" disabled style="display:none" aria-hidden="true"></button>
                            @csrf

                            <div class="mb-3 has-validation">
                                <label for="name" class="form-label fw-bold">Project Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" placeholder="Insert name" name="name" required
                                    value="{{ old('name') }}" autocomplete="name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 has-validation">
                                <label for="link" class="form-label fw-bold">Project Link</label>
                                <input type="text" class="@error('link') is-invalid @enderror form-control"
                                    id="link" placeholder="Insert link" name="link" required
                                    value="{{ old('link') }}">
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 has-validation">
                                <label for="description" class="form-label fw-bold">Description</label>
                                <textarea class="@error('description') is-invalid @enderror form-control" placeholder="Insert Description"
                                    id="description" rows="7" name="description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">

                                <div class="mb-3 w-25">
                                    <label class="fw-bold" for="types">Type</label>
                                    <select class="mt-2 form-select @error('type_id') is-invalid @enderror" name="type_id"
                                        id="types">
                                        <option @selected(!old('type_id')) value="">Select Type</option>
                                        @foreach ($types as $type)
                                            <option @selected(old('type_id') == $type->id) value="{{ $type->id }}">
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
                                                <input @checked(in_array($technology->id, old('technologies', []))) name="technologies[]"
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
                                <img id="preview-image" src="" alt="" style="max-width: 300px">
                            </div>

                            <button class="btn btn-primary" type="submit">SAVE</button>
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
