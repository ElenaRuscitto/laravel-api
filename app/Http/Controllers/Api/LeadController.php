<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;


class LeadController extends Controller
{
    public function store(Request $request) {

        $data = $request->all();

        $validator = Validator::make($data,
            [
                'name' => 'required|min:3|max:100',
                'email' => 'required|email',
                'message' => 'required|min:3'
            ],
            [
                'name.required'=> 'Il Nome è un campo obbligatorio',
                'name.min' => 'Il Nome deve avere almeno :min caratteri',
                'name.max' => 'Il Nome deve avere massimo :max caratteri',
                'email.required'=> "L'Email è un campo obbligatorio",
                'email.email' => "L'Email inserita non ha un formato valido",
                'message.required'=> 'Il Messaggio è un campo obbligatorio',
                'message.min' => 'Il Messaggio deve avere almeno :min caratteri',
            ]
        );

        if($validator->fails()) {
            $success=false;
            $errors=$validator->errors();

            return response()->json(compact('success', 'errors'));
        }

        // salvo nel db la mail
        $new_lead = New Lead();
        $new_lead-> fill($data);
        $new_lead->save();

        // invio l'email
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new NewContact($new_lead));

        $success=true;

        return response()->json(compact('success'));
    }
}
