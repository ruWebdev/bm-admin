<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

use App\Models\Artist;
use App\Models\ArtistPhoto;

use App\Models\Composer;
use App\Models\ComposerPhoto;

use App\Models\MusicalInstrument;
use App\Models\MusicalInstrumentPhoto;

class UploadController extends Controller
{

    public function uploadArtistPhoto($id, Request $request)
    {

        $manager = new ImageManager(new Driver());

        $file = $request->file('file');
        $img = $manager->read($file->path());

        $destinationPath = 'artists/' . $id . '/photo/';
        $fileName = rand() . ".jpg";

        if ($request->type == 'main_photo') {
            $img->scale(width: 200);
        } else {
            $img->scale(width: 500);
        }

        $finalImage = $img->toJpeg(90);

        $path = Storage::disk('public')->put($destinationPath . $fileName, $finalImage);

        $artist = Artist::find($id);

        if ($request->type == 'main_photo') {

            if ($artist->main_photo != '' && $artist->main_photo != 'artists/no-artist-photo.jpg') {
                Storage::disk('public')->delete($artist->main_photo);
            }

            $artist->main_photo = $destinationPath . $fileName;
            $result = $destinationPath . $fileName;

            $artist->save();
        } else if ($request->type == 'page_photo') {

            if ($artist->page_photo != '' && $artist->page_photo != 'artists/no-artist-photo.jpg') {
                Storage::disk('public')->delete($artist->page_photo);
            }

            $artist->page_photo = $destinationPath . $fileName;
            $result = $destinationPath . $fileName;

            $artist->save();
        } else if ($request->type == 'additional_photo') {
            $result = ArtistPhoto::create([
                'composer_id' => $id,
                'file_name' => $fileName,
                'full_path' => $destinationPath . $fileName
            ]);
        }

        return response()->json($result);
    }

    public function uploadComposerPhoto($id, Request $request)
    {

        $manager = new ImageManager(new Driver());



        $file = $request->file('file');
        $img = $manager->read($file->path());

        $destinationPath = 'composers/' . $id . '/photo/';
        $fileName = rand() . ".jpg";

        if ($request->type == 'main_photo') {
            $img->scale(width: 200);
        } else {
            $img->scale(width: 500);
        }

        $finalImage = $img->toJpeg(90);

        $path = Storage::disk('public')->put($destinationPath . $fileName, $finalImage);

        $composer = Composer::find($id);

        if ($request->type == 'main_photo') {

            if ($composer->main_photo != '' && $composer->main_photo != 'composers/no-composer-photo.jpg') {
                Storage::disk('public')->delete($composer->main_photo);
            }

            $composer->main_photo = $destinationPath . $fileName;
            $result = $destinationPath . $fileName;

            $composer->save();
        } else if ($request->type == 'page_photo') {

            if ($composer->page_photo != '' && $composer->page_photo != 'composers/no-composer-photo.jpg') {
                Storage::disk('public')->delete($composer->page_photo);
            }

            $composer->page_photo = $destinationPath . $fileName;
            $result = $destinationPath . $fileName;

            $composer->save();
        } else if ($request->type == 'additional_photo') {
            $result = ComposerPhoto::create([
                'composer_id' => $id,
                'file_name' => $fileName,
                'full_path' => $destinationPath . $fileName
            ]);
        }

        return response()->json($result);
    }

    public function uploadMusicalInstrumentPhoto($id, Request $request)
    {

        $manager = new ImageManager(new Driver());

        $file = $request->file('file');
        $img = $manager->read($file->path());

        $destinationPath = 'instruments/' . $id . '/photo/';
        $fileName = rand() . ".jpg";

        if ($request->type == 'main_photo') {
            $img->scale(width: 200);
        } else {
            $img->scale(width: 500);
        }

        $finalImage = $img->toJpeg(90);

        $path = Storage::disk('public')->put($destinationPath . $fileName, $finalImage);

        $instrument = MusicalInstrument::find($id);

        if ($request->type == 'main_photo') {

            if ($instrument->main_photo != '' && $instrument->main_photo != 'instruments/no-instrument-photo.jpg') {
                Storage::disk('public')->delete($instrument->main_photo);
            }

            $instrument->main_photo = $destinationPath . $fileName;
            $result = $destinationPath . $fileName;

            $instrument->save();
        } else if ($request->type == 'page_photo') {

            if ($instrument->page_photo != '' && $instrument->page_photo != 'instruments/no-instrument-photo.jpg') {
                Storage::disk('public')->delete($instrument->page_photo);
            }

            $instrument->page_photo = $destinationPath . $fileName;
            $result = $destinationPath . $fileName;

            $instrument->save();
        } else if ($request->type == 'additional_photo') {
            $result = MusicalInstrumentPhoto::create([
                'instrument_id' => $id,
                'file_name' => $fileName,
                'full_path' => $destinationPath . $fileName
            ]);
        }

        return response()->json($result);
    }
}
