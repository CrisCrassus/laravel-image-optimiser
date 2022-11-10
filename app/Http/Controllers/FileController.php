<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Traits\ReferenceTrait;
use Illuminate\Http\Request;

class FileController extends Controller
{
    use ReferenceTrait;

    public function optimiseImage($reference, $size) {
        $image = File::where('file_reference', $reference)->first();
        return $image->getImage($size);
    }
    //
}
