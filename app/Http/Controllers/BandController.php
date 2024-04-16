<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class BandController extends Controller
{

    public function index(Request $request)
    {

        $data = array();


        return Inertia::render('Bands/Bands', ['data' => $data]);
    }
}
