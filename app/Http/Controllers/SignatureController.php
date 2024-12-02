<?php

namespace App\Http\Controllers;

use App\Models\Client;

class SignatureController extends Controller
{
    public function index()
    {
        $name = auth()->user()->name;
        $document = Client::where('user_id', auth()->user()->id)->first()->document;
        $status = auth()->user()->client->signatures->first()->status->name;

        return view("test", [
            'name' => $name,
            'document' => $document,
            'status' => $status,
        ]);
    }
}
