<?php

function formatImagePath($image)
{
    if (!$image) {
        return null;
    }

    $explodeImg = explode(config('constants.global.urlApi'), $image, 2);
    if (count($explodeImg) > 1) {
        return $explodeImg[1];
    } else {
        return $image;
    }
}
