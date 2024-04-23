<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\User;
use App\Models\Artist;
use App\Models\MusicalInstrument;

class ArtistController extends Controller
{

    public function index(Request $request)
    {

        $data = array();

        $data['artist_moderation'] = Artist::where('moderation_status', 1)
            ->whereOr('moderation_status', 2)
            ->orderBy('updated_at', 'DESC')
            ->get();

        $data['artist'] = Artist::where('moderation_status', 0)
            ->whereOr('moderation_status', 4)
            ->orderBy('updated_at', 'DESC')
            ->get();

        return Inertia::render('Artists/Artists', ['data' => $data]);
    }

    public function createArtist(Request $request)
    {

        Artist::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'user_id' => auth()->user()->id
        ]);

        $user = User::find(auth()->user()->id);
        $user->is_connected_to_artist = true;
        $user->save();

        return response('success');
    }

    public function requestModeration($id)
    {
        $artist = Artist::find($id);
        $artist->moderation_status = 1;
        $artist->save();
    }

    public function connectArtist(Request $request)
    {

        $artist = Artist::where('last_name', $request->last_name)
            ->where('first_name', $request->first_name)
            ->first();

        $artist->user_id = auth()->user()->id;
        $artist->save();

        $user = User::find(auth()->user()->id);
        $user->is_connected_to_artist = true;
        $user->save();

        return response('success');
    }


    public function updateArtist($id, Request $request)
    {

        $artist = Artist::find($id);

        $artist->page_alias = $request->page_alias;
        $artist->last_name = $request->last_name;
        $artist->first_name = $request->first_name;
        $artist->middle_name = $request->middle_name;
        $artist->birth_place = $request->birth_place;
        $artist->birth_date = $request->birth_date;
        $artist->musical_instruments = $request->musical_instruments;
        $artist->short_description = $request->short_description;
        $artist->long_description = $request->long_description;
        $artist->show_birth_place = $request->show_birth_place;
        $artist->show_birth_date = $request->show_birth_date;
        $artist->enable = $request->enable;

        $artist->save();
    }

    public function searchArtist(Request $request)
    {

        $artists = Artist::where('last_name', $request->last_name)
            ->where('first_name', $request->first_name)
            ->where('user_id', null)
            ->get();

        return response()->json($artists);
    }
}
