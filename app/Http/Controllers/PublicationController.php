<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Mail\PublicationModerationAccept;
use App\Mail\PublicationModerationDeny;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\Publication;

class PublicationController extends Controller
{

    public function index(Request $request)
    {

        $data = array();

        $data['publications'] = Publication::orderBy('created_at', 'DESC')
            ->get();


        return Inertia::render('Publications/Publications', ['data' => $data]);
    }

    public function createPublication(Request $request)
    {

        $newItem = Publication::create(
            [
                'title' => $request->data['title'],
                'main_photo' => 'publications/no-publication-image.jpg',
                'page_photo' => 'publications/no-publication-image.jpg',
                'moderation_status' => 3,
            ]
        );

        return response()->json($newItem);
    }

    public function viewPublication($id)
    {

        $data = array();

        $data['publication'] = Publication::find($id);

        return Inertia::render('Publications/ViewPublication', ['data' => $data]);
    }

    public function updatePublication($id, Request $request)
    {
        $publication = Publication::find($id);

        $publication->page_alias = $request->page_alias;
        $publication->title = $request->title;
        $publication->short_description = $request->short_description;
        $publication->long_description = $request->long_description;
        $publication->enable_page = $request->enable_page;

        $publication->save();
    }

    public function acceptModeration($id)
    {
        $publication = Publication::find($id);
        $publication->moderation_status = 3;
        $publication->save();

        $user = User::find($publication->user_id);

        Mail::to($user->email)->send(new PublicationModerationAccept());
    }

    public function denyModeration($id)
    {
        $publication = publication::find($id);
        $publication->moderation_status = 2;
        $publication->save();

        $user = User::find($publication->user_id);

        Mail::to($user->email)->send(new PublicationModerationDeny());
    }
}
