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
        'thumbnailIcon' => [100, 100], // homepage
        'thumbnailDoctor' => [120, 120], // chu-de-tu-van
        'medium' => [400, 400],
        'larage' => [600, 600],
        'thumbnailBannerMain' => [400, 200],
        'thumbnailBannerFooter' => [200, 100],
        'bannerMain' => [1903, 513], // homepage
        'bannerOnePage' => [1260, 230],
        'bannerFooter' => [150, 150],
        // 'bannerFooter' => [132, 90],
        'doctor' => [212, 277],
        // 'doctorMobile' => [150, 195],
        'doctorPopup' => [212, 277],
        // 'doctorPopup' => [180, 235],
        'logoMobile' => [390, 70],
        'logoDesktop' => [474, 85],
        'photos-videos' => [502, 340],
        'infrastructure' => [502, 340],
        'infrastructureHome' => [502, 340],
        'larageNews' => [1450, 820],
        'thumbnailNews' => [502, 340],
        'mediumNews' => [502, 340],
        'larageNewsCatalogy' => [1450, 820],
        'mediumNewsCatalogy' => [502, 340],
    ],
];
