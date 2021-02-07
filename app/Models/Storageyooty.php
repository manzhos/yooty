<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Storageyooty extends Model
{
    public function upload(Request $request)
    {
        // upload file
        if ($request->isMethod('post') && $request->file('userfile')) {

            $file = $request->file('userfile');
            $upload_folder = 'public/folder';
            $filename = $file->getClientOriginalName(); // image.jpg

            Storageyooty::putFileAs($upload_folder, $file, $filename);

        }
    }
}
