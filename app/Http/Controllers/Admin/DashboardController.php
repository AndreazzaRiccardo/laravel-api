<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        return view('admin.dashboard');
    }

    public function show() {
        $user_details = Auth::user()->userDetails;
        if($user_details){
            if($user_details->address == null && $user_details->phone == null && $user_details->date_of_birth == null) {
                $user_details->delete();
                return redirect()->route('admin.user_details.show');
            }
        }

        return view('admin.user_details.show', compact('user_details'));
    }

    public function create() {
        $user_details = Auth::user()->userDetails;

        return view('admin.user_details.create', compact('user_details'));
    }

    public function store(Request $request)
    {
        $details = new UserDetails();

        $details->fill($request->all());
        $details->user_id = Auth::user()->id;

        $details->save();

        return redirect()->route('admin.user_details.show');
    }

    public function edit()
    {
        $user_details = Auth::user()->userDetails;

        return view('admin.user_details.edit', compact('user_details'));
    }

    public function update(Request $request)
    {
        $user_details = Auth::user()->userDetails;

        $user_details->update($request->all());
        
        return redirect()->route('admin.user_details.show');
    }
}
