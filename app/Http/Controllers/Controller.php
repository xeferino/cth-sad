<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function saveBase64($base64, $path, $name) {
        $image = str_replace('data:image/jpeg;base64,', '', $base64);
        $image = str_replace(' ', '+', $image);
        if (!File::exists(public_path($path))){
        	File::makeDirectory(public_path($path));
        }
        File::put(public_path($path).$name, base64_decode($image));
        return $name;
    }
}
