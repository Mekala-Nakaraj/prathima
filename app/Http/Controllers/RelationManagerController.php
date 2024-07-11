<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RelationManagerController extends Controller
{
    public function RelationManagerShow()
    {
        return view('backend.dashboard');
    }
}
