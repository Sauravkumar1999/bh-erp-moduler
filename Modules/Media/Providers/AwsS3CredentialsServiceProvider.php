<?php

namespace Modules\Media\Providers;

use Illuminate\Support\Arr;
use Aws\S3\S3Client;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Aws\Credentials\CredentialProvider;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class AwsS3CredentialsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('s3cached', function ($app, $config) {

            $s3Config = $config;
            $s3Config['version'] = 'latest';

            if (! empty($config['key']) && ! empty($config['secret'])) {
                $s3Config['credentials'] = Arr::only($config, ['key', 'secret', 'token']);
            } else {
                $provider = CredentialProvider::defaultProvider();
                $s3Config['credentials'] = CredentialProvider::memoize($provider);

            }

            $root = $s3Config['root'] ?? null;
            $options = $config['options'] ?? [];
            $streamReads = $config['stream_reads'] ?? false;

            return new Filesystem(new AwsS3Adapter(new S3Client($s3Config), $s3Config['bucket'], $root, $options, $streamReads), $config);
        });
    }
}
