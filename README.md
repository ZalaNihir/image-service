```bash

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nihir\ImageService\ImageService;

class ImageController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function upload(Request $request)
    {
        // Example usage of ImageService
        $image = $request->file('image');
        $uniqueSlug = 'example'; // Generate unique slug
        $type = 'slider'; // Example type
        $path = 'uploads'; // Example path
        $extension = 'webp'; // Example extension

        $filename = $this->imageService->convert($image, $uniqueSlug, $type, $path, $extension);

        if ($filename) {
            // Image converted successfully
            return response()->json(['success' => true, 'filename' => $filename]);
        } else {
            // Handle conversion failure
            return response()->json(['success' => false, 'message' => 'Failed to convert image.']);
        }
    }
}

```
