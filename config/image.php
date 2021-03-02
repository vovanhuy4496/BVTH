<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',

    'sizes' => [
        'thumbnail' => [150, 150],
        'medium' => [400, 400],
        'larage' => [600, 600],
        'thumbnailBannerMain' => [400, 200],
        'thumbnailBannerFooter' => [200, 100],
        'bannerMain' => [1440, 520],
        'bannerOnePage' => [1260, 230],
        'bannerFooter' => [132, 90],
        'doctor' => [212, 277],
        'doctorMobile' => [150, 195],
        'doctorPopup' => [180, 235],
        'logoMobile' => [300, 53],
        'logoDesktop' => [474, 85],
        'photos-videos' => [260, 173],
        'infrastructure' => [360, 225]
    ],
];
