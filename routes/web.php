<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

Route::get('/texus-assets/{file}', function ($file) {
    $path = __DIR__ . '/../public/' . $file;

    if (!File::exists($path)) {
        abort(404);
    }
    $mimeType = File::mimeType($path);
    return Response::file($path, ['Content-Type' => $mimeType]);
})->where('file', '.*');
