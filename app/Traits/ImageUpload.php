<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait ImageUpload
{
    public function UserImageUpload($data, $request, $path, $object = null) // Taking input image as parameter
    {
        if ($request->hasFile('image')) {
            if ($object) {
                if ($object->image) {
                    if (file_exists(storage_path() .$path.$object->image)){

                        unlink(storage_path().$path . $object->image);
                    }
                }
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs($path, $imageName);
            $data['image'] = $imageName;
        }

        return $data; // Just return image
    }
    public function UserImagesUpload($data, $request, $path, $object = null) // Taking input image as parameter
    {
        if ($request->hasFile('images')) {
            if ($object) {
                if ($object->images) {
                    $imagesArr = explode(',', $object->images);
                    foreach ($imagesArr as $item) {
                        if (file_exists(storage_path() . $path.$item)) {
                            unlink(storage_path().$path . $item);
                        }
                    }
                }
            }
            $imagesName = [];
            foreach ($request->images as $key => $item) {
                $imageName = time() . '_' . $key . '.' . $item->extension();
                $item->storeAs($path, $imageName);
                $imagesName[] = $imageName;
            }
            $imageString = implode(',', $imagesName);
            $data['images'] = $imageString;
        }

        return $data; // Just return image
    }
}
?>
