<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class NewsImageController extends Controller
{
    public function show(string $filename)
    {
        $path = 'private-news/' . $filename;

        if (!Storage::disk('private')->exists($path)) {
            abort(404);
        }

        $file = Storage::disk('private')->get($path);
        $mime = Storage::disk('private')->mimeType($path); // MIMEタイプを取得 この記述で問題なしとのこと

        return response($file, 200)->header('Content-Type', $mime);
    }
}

