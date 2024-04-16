<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Artist;

class ArtistController extends Controller
{

    public function index(Request $request)
    {

        $data = array();

        $data['artist'] = Artist::where('user_id', auth()->user()->id)
            ->firstOrCreate([
                'user_id' => auth()->user()->id
            ]);

        return Inertia::render('Artist/Artist', ['data' => $data]);
    }
}
