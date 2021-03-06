<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. A "local" driver, as well as a variety of cloud
    | based drivers are available for your choosing. Just store away!
    |
    | Supported: "local", "ftp", "s3", "rackspace"
    |
    */

    'default' => 'local',

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => 's3',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => 'your-key',
            'secret' => 'your-secret',
            'region' => 'your-region',
            'bucket' => 'your-bucket',
        ],

        'qiniu' => [
            'driver'     => 'qiniu',
            'access_key' => env('QINIU_ACCESS_KEY', 'ymCF6XDDZM0XoF5aXO_2y09DkJrMThYC9OxMHT3o'),
            'secret_key' => env('QINIU_SECRET_KEY', 'e6FIRZiVGG5oSNc1r1pRRdHxT5B9qVXHyACuS2DF'),
            'bucket'     => env('QINIU_BUCKET', 'zunyue'),
            'domain'     => env('QINIU_DOMAIN', 'onpidf33z.bkt.clouddn.com'),
        ],

    ],

];
