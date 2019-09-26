<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends AdminController
{
    public function upload(Request $request)
    {
        $file = $request->file('upload');
        $url = $file->storeAs('content', md5(uniqid()).'.'.$file->extension(), 'admin');
        $url = env('APP_URL').'/uploads/'.$url;

        return  $url;
    }
}