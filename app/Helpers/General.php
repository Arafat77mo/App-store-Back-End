<?php

// save images
function uploadImage($folder,$image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = URL::to('/') .'/public/assets/images/' . $folder . '/' . $filename;
    return $path;
}




