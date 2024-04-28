<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use Illuminate\Http\Request;

use App\Models\Band;
use App\Models\BandParticipant;
use App\Models\BandPhoto;


class BandController extends Controller
{

    public function index(Request $request)
    {

        $data = array();

        $data['band_moderation'] = Band::where('moderation_status', 1)
            ->orWhere('moderation_status', 2)
            ->orderBy('updated_at', 'DESC')
            ->get();

        $data['bands'] = Band::where('moderation_status', 0)
            ->orWhere('moderation_status', 4)
            ->orderBy('updated_at', 'DESC')
            ->get();

        return Inertia::render('Bands/Bands', ['data' => $data]);
    }

    public function getAllBands(Request $request)
    {

        $band = Band::orderBy('title', 'ASC')
            ->get();

        return response()->json($band);
    }


    public function createBand(Request $request)
    {

        if ($request->band_id == null && $request->participation == 1) {
            $band = Band::create(
                [
                    'user_id' => auth()->user()->id,
                    'title' => $request->title,
                    'enable' => 0,
                    'moderation_status' => 0,
                    'status' => 0,
                ]
            );
            BandParticipant::create([
                'user_id' => auth()->user()->id,
                'band_id' => $band->id,
                'role' => 'creator',
            ]);
        } else if ($request->band_id == null && $request->participation == 2) {
            $band = Band::create(
                [
                    'title' => $request->title,
                    'enable' => 0,
                    'moderation_status' => 0,
                    'status' => 0,
                ]
            );
            BandParticipant::create([
                'user_id' => auth()->user()->id,
                'band_id' => $band->id,
                'role' => 'participant',
            ]);
        }

        $bands = BandParticipant::where('user_id', auth()->user()->id)
            ->with('band')
            ->get();

        return response()->json($bands);
    }

    public function createBandFromSelect(Request $request)
    {

        $band = Band::create([
            'title' => $request->title,
            'main_photo' => 'bands/no-band-image.jpg',
            'page_photo' => 'bands/no-band-image.jpg'
        ]);

        return response()->json($band);
    }

    public function connectBand(Request $request)
    {

        BandParticipant::create([
            'user_id' => auth()->user()->id,
            'band_id' => $request->band_id,
            'role' => 'participant',
        ]);

        $bands = BandParticipant::where('user_id', auth()->user()->id)
            ->with('band')
            ->get();

        return response()->json($bands);
    }

    public function disconnectBand(Request $request)
    {

        BandParticipant::where('user_id', auth()->user()->id)
            ->where('band_id', $request->band_id)
            ->delete();

        $bands = BandParticipant::where('user_id', auth()->user()->id)
            ->with('band')
            ->get();

        return response()->json($bands);
    }

    public function viewBand($id)
    {

        $data = array();

        $data['band'] = Band::find($id);
        $data['band_photos'] = BandPhoto::where('band_id', $id)->get();

        return Inertia::render('Bands/ViewBand', ['data' => $data]);
    }

    public function updateBand($id, Request $request)
    {
        $band = Band::find($id);

        $band->name = $request->name;
        $band->short_description = $request->short_description;
        $band->long_description = $request->long_description;
        $band->country = $request->country;
        $band->city = $request->city;
        $band->page_alias = $request->page_alias;
        $band->external_link = $request->external_link;

        $band->save();
    }

    public function searchBand(Request $request)
    {

        $band = 'not found';


        $result = Band::where('title', 'LIKE', '%' . $request->title . '%')
            ->first();

        if ($result) {
            $band = $result;
        }

        return response()->json($band);
    }
}
