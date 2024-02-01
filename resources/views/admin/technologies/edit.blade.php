@extends('layouts.admin')

@section('admin_page_name')
    EditTechnology
@endsection

@section('content')
    <div class="container mt-4">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1>EDIT TECHNOLOGY</h1>
                        {{-- Back Button --}}
                        <a href="{{ route('admin.technologies.show', ['technology' => $technology->id]) }}"
                            class="btn btn-primary float-end">BACK</a>
                    </div>
                    <div class="card-body">

                        {{-- Edit Form --}}
                        <form action="{{ route('admin.technologies.update', ['technology' => $technology->id]) }}"
                            method="POST">
                            <button type="submit" disabled style="display:none" aria-hidden="true"></button>
                            @csrf
                            @method('PUT')

                            <div class="mb-3 has-validation">
                                <label for="name" class="form-label fw-bold">Technology Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" placeholder="Insert name" name="name" required
                                    value="{{ old('name', $technology->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 has-validation">
                                <label for="description" class="form-label fw-bold">Description</label>
                                <textarea class="@error('description') is-invalid @enderror form-control" placeholder="Insert Description"
                                    id="description" rows="7" name="description">{{ old('description', $technology->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 has-validation">
                                <label for="hex_color" class="form-label fw-bold">Badge Color</label>
                                <input type="color"
                                    class="form-control form-control-color @error('hex_color') is-invalid @enderror"
                                    id="hex_color" placeholder="Choose your color" name="hex_color" required
                                    value="{{ old('hex_color', $technology->hex_color) }}">
                                @error('hex_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <a class="btn btn-secondary"
                                    href="{{ route('admin.technologies.edit', ['technology' => $technology->id]) }}">RESET</a>
                                <button class="btn btn-primary" type="submit">SAVE</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
