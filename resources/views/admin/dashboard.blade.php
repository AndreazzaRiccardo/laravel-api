@extends('layouts.admin')

@section('admin_page_name')
    DashBoard
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="card fs-5">
                    <h1 class="card-header text-center">{{ __('Welcome to your Dashboard') }}</h1>

                    <div class="card-body mb-0 text-center alert alert-success">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h2>Hello {{ Auth::user()->name }}, you are loggin !!!</h2>
                    </div>
                </div>
                <h2 class="text-center mt-3"><strong>Total Projects: </strong>{{ count(Auth::user()->projects) }}</h2>
            </div>
        </div>
    </div>
@endsection
