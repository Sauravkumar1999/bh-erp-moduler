<?php

namespace Modules\Media\Http\Controllers;

use Plank\Mediable\Media;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class MediaViewController extends Controller
{
    /**
     * Display Image by Plank\Mediable\Media
     *
     * @param Media $media
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function displayImage(Media $media)
    {
        return Storage::disk($media->disk)->download($media->getDiskPath());
    }

    /**
     * Display Image by file basename
     *
     * @param $filename
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|null
     */
    public function showImage($filename)
    {
        if ($filename) {
            $media = Media::whereBasename($filename)->first();

            return $media ? Storage::disk($media->disk)->download($media->getDiskPath()) : null;
        }
        return null;
    }


    /**
     * Download S3 objects
     *
     * @param $file
     * @return string
     */
    public function downloadS3Objects($file)
    {
        $path = $this->getS3URL() . $file;
        return Storage::disk(Config::get('media.drive'))->url($path);
    }


    /**
     * Get the S3 Objects URL
     *
     * @param string $dir
     * @return string
     */
    private function getS3URL(string $dir = 'downloads'): string
    {
        return "https://" . env('AWS_BUCKET') . ".s3." . env('AWS_DEFAULT_REGION') . ".amazonaws.com/" . $dir . "/";
    }

}
