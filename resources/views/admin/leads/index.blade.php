@extends('layouts.admin')

@section('admin_page_name')
    LeadsPage
@endsection

@section('content')

    {{-- Leads Table --}}
    <div class="container">

        @if (count($leads) > 0)
            <h1>LEADS</h1>

            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leads as $lead)
                        <tr>
                            <th class="opacity-75" scope="row">{{ $lead->id }}</th>
                            <td class="opacity-75">{{ $lead->name }}</td>
                            <td class="opacity-75">{{ $lead->lastname }}</td>
                            <td class="opacity-75">{{ $lead->email }}</td>
                            <td class="opacity-75">{{ $lead->phone_number }}</td>
                            <td class="opacity-75">{{ $lead->message }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination me-5">
                {{ $leads->render() }}
            </div>
    </div>
@else
    <div class="d-flex flex-column align-items-center mb-4">
        <h2>THERE ARE NO PROJECTS TO VIEW</h2>
        <a class="btn btn-secondary" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-trash"></i></a>
    </div>
    @endif

    </div>


@endsection
