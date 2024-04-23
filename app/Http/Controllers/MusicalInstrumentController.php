<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\MusicalInstrument;

class MusicalInstrumentController extends Controller
{

    public function index(Request $request)
    {

        $data = array();

        $data['instruments'] = MusicalInstrument::orderBy('title', 'ASC')
            ->get();


        return Inertia::render('Instruments/Instruments', ['data' => $data]);
    }

    public function createComposer(Request $request)
    {

        $newItem = Composer::create(
            [
                'last_name' => $request->data['last_name'],
                'first_name' => $request->data['first_name'],
                'main_photo' => 'composers/no-composer-image.jpg',
                'page_photo' => 'composers/no-composer-image.jpg'
            ]
        );

        return response()->json($newItem);
    }

    public function viewMusicalInstrument($id)
    {

        $data = array();

        $data['instrument'] = MusicalInstrument::find($id);

        return Inertia::render('Instruments/ViewInstrument', ['data' => $data]);
    }

    public function updateMusicalInstrument($id, Request $request)
    {
        $composer = MusicalInstrument::find($id);

        $composer->title = $request->title;
        $composer->title_rod = $request->title_rod;
        $composer->short_description = $request->short_description;
        $composer->long_description = $request->long_description;
        $composer->page_alias = $request->page_alias;
        $composer->enabled = true;

        $composer->save();
    }
}
