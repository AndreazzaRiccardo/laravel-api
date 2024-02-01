@extends('layouts.admin')

@section('admin_page_name')
    CreateNewType
@endsection

@section('content')
    <div class="container mt-4">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1>ADD NEW TYPE</h1>
                        {{-- Back Button --}}
                        <a href="{{ route('admin.types.index') }}" class="btn btn-primary float-end">BACK</a>
                    </div>
                    <div class="card-body">

                        {{-- Create Form --}}
                        <form action="{{ route('admin.types.store') }}" method="POST">
                            <button type="submit" disabled style="display:none" aria-hidden="true"></button>
                            @csrf

                            <div class="mb-3 has-validation">
                                <label for="name" class="form-label fw-bold">Type Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" placeholder="Insert name" name="name" required
                                    value="{{ old('name') }}">
                                @error('name')
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

                            <button class="btn btn-primary" type="submit">SAVE</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
