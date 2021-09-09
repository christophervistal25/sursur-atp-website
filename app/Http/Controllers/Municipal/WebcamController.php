<?php

namespace App\Http\Controllers\Municipal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebcamController extends Controller
{
    public function upload(Request $request)
    {
        $image = $request->image;  // your base64 encoded
        list($type, $file_data) = explode(';', $request->image);

        list(, $file_data) = explode(',', $file_data);

        list($imageType, $extension) = explode('/', $type);

        $image = str_replace( $type . ',', '', $image);

        $image = str_replace(' ', '+', $image);

        $imageName = md5(time()) . '_.' . $extension;

        \File::put(storage_path(). '/app/public/images/' . $imageName, base64_decode($file_data));

        return response()->json(['success' => true, 'filename' => $imageName]);
    }
}
