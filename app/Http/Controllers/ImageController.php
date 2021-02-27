<?php

namespace App\Http\Controllers;

use Image;

class ImageController extends Controller
{
    public function flyResize($size, $imagePath)
    {
        $imageFullPath = public_path($imagePath);
        $sizes = config('image.sizes');
    
        if (!file_exists($imageFullPath) || !isset($sizes[$size])) {
            abort(404);
        }
    
        $savedPath = public_path('resizes/' . $size . '/' . $imagePath);
        $savedDir = dirname($savedPath);
        if (!is_dir($savedDir)) {
            mkdir($savedDir, 777, true);
        }
    
        list($width, $height) = $sizes[$size];
    
        $image = Image::make($imageFullPath)->fit($width, $height)->save($savedPath);
    
        return $image->response();
    }
}
