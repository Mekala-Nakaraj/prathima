<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FieldManagerController extends Controller
{
    public function FieldManagerShow()
    {
        return view('backend.dashboard');
    }
}
