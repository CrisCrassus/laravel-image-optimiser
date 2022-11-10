<?php

namespace App\Models;

use App\Traits\ReferenceTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;


class File extends Model
{
    use HasFactory;

    public function generateImageTags($class = null, $altTags = null)
    {
        return "
            <picture>
                <source class='{$class}' alt='{$altTags}' srcset='/optimised_images/{$this->id}/desktop' media='(min-width: 1920px)'>
                <source class='{$class}' alt='{$altTags}' srcset='/optimised_images/{$this->id}/large' media='(min-width: 1600px)'>
                <source class='{$class}' alt='{$altTags}' srcset='/optimised_images/{$this->id}/medium' media='(max-width: 1360px)'>
                <source class='{$class}' alt='{$altTags}' srcset='/optimised_images/{$this->id}/small' media='(max-width: 900px)'>
                <source class='{$class}' alt='{$altTags}' srcset='/optimised_images/{$this->id}/phone' media='(max-width: 500px)'>
                <img  class='{$class}' alt='{$altTags}' src='/optimised_images/{$this->id}/small'>
            </picture>";
    }


    public function getImage($passedSize)
    {
        $imageSizes = ["desktop" => ['height' => 850, 'width' => 1500], "large" => ['height' => 650, 'width' => 1000], "medium" => ['height' => 440, 'width' => 800], "small" => ['height' => 400, 'width' => 600], "phone" => ['height' => 200, 'width' => 400], "grid" => ['height' => 120, 'width' => 300], "2-col-layout-left" => ['height' => 120, 'width' => 300], "2-col-layout-right" => ['height' => 120, 'width' => 200]];
        $size = $imageSizes[$passedSize];
        $pictureFileName = $this->getMedia('files')[0]->file_name;
        $pictureMediaID = $this->getMedia('files')[0]->id;
        if (!file_exists(storage_path('app/public/' . $pictureMediaID . '/' . $pictureFileName))) {
            return;
        }
        $pictureUrl = storage_path('app/public/' . $pictureMediaID . '/' . $pictureFileName);
        $pictureOptimisedPath = storage_path('app/public/optimised_images/');
        $pictureOptimisedFileName = $pictureMediaID . '_' . substr($pictureFileName, 0, strpos($pictureFileName, '.')) . '-' . $passedSize . '.webp';
        $pictureOptimisedUrl = url('storage/optimised_images/' . $pictureOptimisedFileName);
        $pictureSaveLoc = storage_path('app/public/optimised_images/' . $pictureOptimisedFileName);
        $tempImage = null;
        if (!file_exists($pictureOptimisedPath . $pictureOptimisedFileName) && $pictureFileName) {
            $tempImage = Image::make($pictureUrl)->encode('webp', 90);

            if ($size) {
                $tempImage->resize($size['width'], null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $tempImage->save($pictureSaveLoc);
            return $tempImage->response();
        }
        return response()->file($pictureOptimisedPath . $pictureOptimisedFileName);
    }
}
