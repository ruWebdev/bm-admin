<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Composer;

class ComposerController extends Controller
{

    public function index(Request $request)
    {

        $data = array();

        $data['composers'] = Composer::orderBy('last_name', 'ASC')
            ->orderBy('first_name', 'ASC')
            ->get();


        return Inertia::render('Composers/Composers', ['data' => $data]);
    }

    public function createComposer(Request $request)
    {

        $newItem = Composer::create(
            [
                'last_name' => $request->data['last_name'],
                'first_name' => $request->data['first_name'],
            ]
        );

        return response()->json($newItem);
    }

    public function viewComposer($id)
    {

        $data = array();

        $data['composer'] = Composer::find($id);

        return Inertia::render('Composers/ViewComposer', ['data' => $data]);
    }

    public function updateComposer($id, Request $request)
    {
        $composer = Composer::find($id);

        $composer->last_name = $request->last_name;
        $composer->first_name = $request->first_name;
        $composer->first_name_short = $request->first_name_short;
        $composer->birth_date = $request->birth_date;
        $composer->death_date = $request->death_date;
        $composer->short_description = $request->short_description;
        $composer->long_description = $request->long_description;
        $composer->page_alias = $request->page_alias;

        $composer->save();
    }
}
