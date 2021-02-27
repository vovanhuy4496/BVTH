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
        'bannerFooter' => [132, 90],
        'doctor' => [212, 277],
        'doctorPopup' => [180, 235],
        'logoMobile' => [300, 63],
        'logoDesktop' => [474, 85],
        // 'doctorBVTH' => [201, 277],
        // 'albumsBVTH' => [206, 196],
        // 'videoBVTH' => [206, 196],
        // 'infrastructureBVTH' => [238, 200],
        // 'healthcare' => [238, 200],
        // 'packageHealthcare' => [238, 200],
        // 'catalog-departments' => [201, 277],
        // 'newspaper' => [201, 277],
    ],
];
