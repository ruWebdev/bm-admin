<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

use App\Models\Composer;
use App\Models\ComposerPhoto;

class UploadController extends Controller
{
    
    public function uploadComposerPhoto($id, Request $request)
    {

        $manager = new ImageManager(new Driver());

        

        $file = $request->file('file');
        $img = $manager->read($file->path());

        $destinationPath = 'composers/' . $id . '/photo/';
        $fileName = rand() . ".jpg";

        $img->scale(width: 500);

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

}
