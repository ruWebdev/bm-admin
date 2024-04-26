<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\News;

class NewsController extends Controller
{

    public function index(Request $request)
    {

        $data = array();

        $data['news'] = News::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();


        return Inertia::render('News/News', ['data' => $data]);
    }

    public function createItem(Request $request)
    {

        $newItem = News::create(
            [
                'user_id' => auth()->user()->id,
                'title' => $request->data['title'],
                'enable' => 0,
                'archive' => 0,
                'moderation_status' => 0,
                'status' => 0,
            ]
        );

        return response()->json($newItem);
    }

    public function viewItem($id)
    {


        $data['news'] = News::find($id);

        return Inertia::render('News/ViewNews', ['data' => $data]);
    }

    public function updateNews($id, Request $request)
    {

        $news = News::find($id);

        $news->page_alias = $request->page_alias;
        $news->title = $request->title;
        $news->short_description = $request->short_description;
        $news->long_description = $request->long_description;
        $news->external_page = $request->external_page;
        $news->enable_page = $request->enable_page;

        $news->save();
    }
}
