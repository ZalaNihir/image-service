<?php

namespace Nihir\ImageService;

class ImageService
{
    public function convert($image, $uniqueSlug, $type, $path, $extension)
    {
        // Check if image is valid
        $compressedImage = imagecreatefromstring(file_get_contents($image->getRealPath()));
        if (!$compressedImage) {
            // Handle the error or return false
            return false;
        }
        // Set default extension
        if (!$extension) {
            $extension = 'webp';
        }
        $filename = $uniqueSlug . '.' . $extension;
        // Determine save path based on the type
        $savePath = public_path($path . '/' . $type . '/' . $filename);
        // Ensure directory exists
        $directory = dirname($savePath);
        if (!file_exists($directory)) {
            if (!mkdir($directory, 0755, true)) {
                // Handle directory creation failure
                return false;
            }
        }
        imagewebp($compressedImage, $savePath, 100); // Adjust quality as needed
        imagedestroy($compressedImage);
        return $filename;
    }
}
