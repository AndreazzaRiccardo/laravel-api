@extends('layouts.admin')

@section('admin_page_name')
    EditUserInfo
@endsection

@section('content')
    <div class="container mt-4">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1>EDIT USER INFO</h1>
                        {{-- Back Button --}}
                        <a href="{{ route('admin.user_details.show') }}" class="btn btn-primary float-end">BACK</a>
                    </div>
                    <div class="card-body">

                        {{-- Edit Form --}}
                        <form action="{{ route('admin.user_details.update') }}" method="POST">
                            <button type="submit" disabled style="display:none" aria-hidden="true"></button>
                            @csrf
                            @method('PUT')
                            <div class="mb-3 has-validation">
                                <label for="address" class="form-label fw-bold">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="Insert address"
                                    name="address" value="{{ old('address', $user_details->address) }}">
                            </div>
                            <div class="mb-3 has-validation">
                                <label for="phone" class="form-label fw-bold">Phone</label>
                                <input type="text" class="form-control" id="phone" placeholder="Insert phone"
                                    name="phone" value="{{ old('phone', $user_details->phone) }}">
                            </div>
                            <div class="mb-3 has-validation">
                                <label for="date_of_birth" class="form-label fw-bold">Date Of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth"
                                    placeholder="Insert date_of_birth" name="date_of_birth"
                                    value="{{ old('date_of_birth', $user_details->date_of_birth) }}">
                            </div>

                            <button class="btn btn-primary" type="submit">SAVE</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
