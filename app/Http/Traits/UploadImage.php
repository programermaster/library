<?php

namespace App\Http\Traits;

use App\Http\Requests\Author\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

trait UploadImage
{

    /**
     * Collect uri parameters from query string for pagination and searching.
     *
     * @param  Request  $request
     * @return Collection
     */
    public function uploadImage(Request $request){
        if ($request->file('image') !== null) {

            $this->createAuthorFolder();

            $photo = $request->file('image');
            Storage::disk('public')->put("authors/".$photo->getClientOriginalName(), file_get_contents($photo));
            return $photo->getClientOriginalName();
        }
    }

    public function createAuthorFolder()
    {
        if (!Storage::disk('public')->exists('authors')) {
            Storage::disk('public')->makeDirectory('authors', 0775, true);
        }
    }
}
