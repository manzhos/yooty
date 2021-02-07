<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function demandes()
    {
        return view('demandes');
    }

    public function messages()
    {
        return view('messages');
    }

    public function successful()
    {
        return view('messages.successful');
    }
}
