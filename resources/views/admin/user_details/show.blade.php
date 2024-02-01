@extends('layouts.admin')

@section('admin_page_name')
    UserDetails
@endsection

@section('content')
    {{-- User Details --}}
    <div class="container fs-5">
        
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>{{ Auth::user()->name }}</h2>
            </div>
            {{-- Back Button --}}
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary float-end">BACK</a>
        </div>
        <hr>
        @if ($user_details)
            @if ($user_details->address)
                <div class="mt-4">
                    <strong>Address:</strong>
                    {{ $user_details->address }}
                </div>
            @else
                <div class="mt-4">
                    <strong>Address:</strong>
                    <a href="{{ route('admin.user_details.edit') }}">Insert Your Address</a>
                </div>
            @endif

            @if ($user_details->phone)
                <div class="mt-4">
                    <strong>Phone:</strong>
                    {{ $user_details->phone }}
                </div>
            @else
                <div class="mt-4">
                    <strong>Phone:</strong>
                    <a href="{{ route('admin.user_details.edit') }}">Insert Your Phone</a>
                </div>
            @endif

            @if ($user_details->date_of_birth)
                <div class="mt-4">
                    <strong>Date Of Birth:</strong>
                    {{ $user_details->date_of_birth }}
                </div>
            @else
                <div class="mt-4">
                    <strong>Date Of Birth:</strong>
                    <a href="{{ route('admin.user_details.edit') }}">Insert Your Date Of Birth</a>
                </div>
            @endif
        @else
            <div class="d-flex gap-4 align-items-center">
                <h2>ADD YOUR ACCOUNT DETAILS</h2>
                <a class="btn btn-primary" href="{{ route('admin.user_details.create') }}">ADD INFO</a>
            </div>
        @endif

    </div>
@endsection
