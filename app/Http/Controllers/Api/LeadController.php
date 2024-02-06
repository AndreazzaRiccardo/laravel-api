<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeadRequest;
use App\Mail\NewLead;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request) {
        $form_data = $request->all();

        // Creo una validazione dati tramite il validator

        $validator = Validator::make($form_data, [
            'name' => ['required'],
            'lastname' => ['required'],
            'email' => ['required', 'email'],
            'phone_number' => ['nullable'],
            'message' => ['required']
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' =>false,
                'errors' => $validator->errors()
            ]);
        }

        // Se la validazione va a buon fine salvo i dati

        $lead = new Lead();
        $lead->fill($form_data);
        $lead->save();

        Mail::to('admin@boolfolio.com')->send(new NewLead($lead));

        return response()->json([
            'success' => true,
        ]);
    }
}
