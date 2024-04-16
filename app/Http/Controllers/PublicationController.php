<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PublicationController extends Controller
{

    public function index(Request $request)
    {

        $data = array();


        return Inertia::render('Publications/Publications', ['data' => $data]);
    }
}
