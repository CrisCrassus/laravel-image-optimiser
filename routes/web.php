<?php

use App\Models\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('optimised_images/{id}/{size}', function($id, $size) {
    $file = File::withTrashed()->findOrFail($id);
    return $file->getImage($size);
});
