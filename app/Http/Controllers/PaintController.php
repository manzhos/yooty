<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaintController extends Controller
{
    public function paint()
    {
        return view('paint.index');
    }
}
