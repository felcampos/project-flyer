<?php

namespace App\Http\Controllers;

use App\Photo;

class PhotosController extends Controller
{
    public function destroy(Photo $photo)
    {
        $photo->delete();

        return back();
    }
}
