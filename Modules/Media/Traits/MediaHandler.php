<?php

namespace Modules\Media\Traits;

use Intervention\Image\Facades\Image;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Config;
use Plank\Mediable\Facades\MediaUploader;
use Plank\Mediable\Media;

trait MediaHandler
{
    /**
     * @param $file
     * @param User|null $user
     * @throws \Plank\Mediable\Exceptions\MediaUpload\ConfigurationException
     * @throws \Plank\Mediable\Exceptions\MediaUpload\FileExistsException
     * @throws \Plank\Mediable\Exceptions\MediaUpload\FileNotFoundException
     * @throws \Plank\Mediable\Exceptions\MediaUpload\FileNotSupportedException
     * @throws \Plank\Mediable\Exceptions\MediaUpload\FileSizeException
     * @throws \Plank\Mediable\Exceptions\MediaUpload\ForbiddenException
     */
    public function uploadAvatar($file, User $user = null): void
    {
        $user = $user ?? auth()->user();

        $media = MediaUploader::fromSource($file)
            ->toDisk(Config::get('media.drive'))
            ->toDirectory($user->id)
            ->useHashForFilename()
            ->withOptions($this->getOptions())
            ->upload();
        $user->syncMedia($media, 'avatar');

        // $file->delete();
    }


    /**
     * @param $file
     * @return Media
     * @throws \Plank\Mediable\Exceptions\MediaUpload\ConfigurationException
     * @throws \Plank\Mediable\Exceptions\MediaUpload\FileExistsException
     * @throws \Plank\Mediable\Exceptions\MediaUpload\FileNotFoundException
     * @throws \Plank\Mediable\Exceptions\MediaUpload\FileNotSupportedException
     * @throws \Plank\Mediable\Exceptions\MediaUpload\FileSizeException
     * @throws \Plank\Mediable\Exceptions\MediaUpload\ForbiddenException
     */
    public function uploadCompanyImage($file): Media
    {
        return MediaUploader::fromSource($file)
            ->toDisk(Config::get('media.drive'))
            ->toDirectory('company')
            ->useHashForFilename()
            ->withOptions($this->getOptions())
            ->upload();
    }

    public function uploadContract($file): Media
    {
        return MediaUploader::fromSource($file)
            ->toDisk(Config::get('media.drive'))
            ->toDirectory('contract')
            ->useHashForFilename()
            ->withOptions($this->getOptions())
            ->upload();
    }

    public function uploadProductCompanyImage($file): Media
    {
        return MediaUploader::fromSource($file)
            ->toDisk(Config::get('media.drive'))
            ->toDirectory('productcompany')
            ->useHashForFilename()
            ->withOptions($this->getOptions())
            ->upload();
    }

    public function uploadProductCompanyContract($file): Media
    {
        return MediaUploader::fromSource($file)
            ->toDisk(Config::get('media.drive'))
            ->toDirectory('productcompanycontract')
            ->useHashForFilename()
            ->withOptions($this->getOptions())
            ->upload();
    }

    public function uploadPostImage($file): Media
    {
        return MediaUploader::fromSource($file)
            ->toDisk(Config::get('media.drive'))
            ->toDirectory('bulletin')
            ->useHashForFilename()
            ->withOptions($this->getOptions())
            ->upload();
    }

    public function uploadAllowancePayment($file): Media
    {
        return MediaUploader::fromSource($file)
            ->toDisk(Config::get('media.drive'))
            ->toDirectory('allowance-payment')
            ->useHashForFilename()
            ->withOptions($this->getOptions())
            ->upload();
    }

    public function uploadBankbookImage($file): Media
    {
        return MediaUploader::fromSource($file)
            ->toDisk(Config::get('media.drive'))
            ->toDirectory('bankbook')
            ->useHashForFilename()
            ->withOptions($this->getOptions())
            ->upload();

//        Image::make($media->getAbsolutePath())->fit(200, 200)->save();
//
//        return $media;
    }

    public function uploadIdCardImage($file): Media
    {
        return MediaUploader::fromSource($file)
            ->toDisk(Config::get('media.drive'))
            ->toDirectory('IdCard')
            ->useHashForFilename()
            ->withOptions($this->getOptions())
            ->upload();
    }

    public function uploadBannerImage($file): Media
    {
        return MediaUploader::fromSource($file)
            ->toDisk(Config::get('media.drive'))
            ->toDirectory('banner')
            ->useHashForFilename()
            ->withOptions($this->getOptions())
            ->upload();
    }

    public function uploadPageMetaImage($file): Media
    {
        return MediaUploader::fromSource($file)
            ->toDisk(Config::get('media.drive'))
            ->toDirectory('og_image')
            ->useHashForFilename()
            ->withOptions($this->getOptions())
            ->upload();
    }

    public function uploadSliderItemImage($file): Media
    {
        return MediaUploader::fromSource($file)
            ->toDisk(Config::get('media.drive'))
            ->toDirectory('slider')
            ->useHashForFilename()
            ->withOptions($this->getOptions())
            ->upload();
    }

    public function uploadSalesPerson($file): Media
    {
        $media = MediaUploader::fromSource($file)
            ->toDisk(Config::get('media.drive'))
            ->toDirectory('sales-person')
            ->useHashForFilename()
            ->withOptions($this->getOptions())
            ->upload();
        return $media;
    }

    public function uploadMonthlyNewsImage($file): Media
    {
        return MediaUploader::fromSource($file)
            ->toDisk(Config::get('media.drive'))
            ->toDirectory('monthly-news')
            ->useHashForFilename()
            ->withOptions($this->getOptions())
            ->upload();
    }

    private function getOptions()
    {
        return ['visibility' => config('filesystems.disks.' . env('FILESYSTEM_DRIVER') . '.visibility', 'public')];
    }
}
