<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\UploadedFile;
use Exception;

trait UploadsImages
{
    /**
     * Uploads an image to Cloudinary using their REST API.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @return string The secure URL of the uploaded image
     * @throws Exception
     */
    public function uploadToCloudinary(UploadedFile $file, $folder = 'portfolio')
    {
        $cloudinaryUrl = env('CLOUDINARY_URL');
        
        if (!$cloudinaryUrl) {
            throw new Exception("CLOUDINARY_URL is not set in the environment.");
        }

        $parsed = parse_url($cloudinaryUrl);
        $cloudName = $parsed['host'];
        $apiKey = $parsed['user'];
        $apiSecret = $parsed['pass'];

        $timestamp = time();
        $signatureString = "folder={$folder}&timestamp={$timestamp}" . $apiSecret;
        $signature = sha1($signatureString);

        $response = Http::attach(
            'file', file_get_contents($file->getRealPath()), $file->getClientOriginalName()
        )->post("https://api.cloudinary.com/v1_1/{$cloudName}/image/upload", [
            'api_key' => $apiKey,
            'timestamp' => $timestamp,
            'signature' => $signature,
            'folder' => $folder,
        ]);

        if ($response->successful()) {
            return $response->json()['secure_url'];
        }

        throw new Exception("Cloudinary Upload Failed: " . $response->body());
    }
}
