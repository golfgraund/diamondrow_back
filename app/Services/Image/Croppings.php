<?php

namespace App\Services\Image;

class Croppings
{
    /**
     * Block editor
     */
    const BLOCK_EDITOR_ROLE_NAME = self::FREE_RATIO_ROLE_NAME;
    const BLOCK_EDITOR_CROP_NAME = self::FREE_RATIO_CROP_NAME;

    const BLOCK_EDITOR = self::CROPS;

    /**
     * Free ratio
     */
    const FREE_RATIO_ROLE_NAME = 'image_1';
    const FREE_RATIO_CROP_NAME = 'desktop';

    const EXTRA_PARAMS = [
        'extra' => [
            'lqip' => ['w' => 5, 'fit' => 'max', 'auto' => 'format'],

            'srcset' => [
                [
                    '__glue' => ', ',
                    '__items' => [
                        [
                            'auto' => 'format',
                            'q' => 85,
                            'fit' => 'max',
                            'w' => '200 200w',
                        ],
                        [
                            'auto' => 'format',
                            'q' => 85,
                            'fit' => 'max',
                            'w' => '400 400w',
                        ],
                        [
                            'auto' => 'format',
                            'q' => 85,
                            'fit' => 'max',
                            'w' => '800 800w',
                        ],
                        [
                            'auto' => 'format',
                            'q' => 85,
                            'fit' => 'max',
                            'w' => '1200 1200w',
                        ],
                        [
                            'auto' => 'format',
                            'q' => 85,
                            'fit' => 'max',
                            'w' => '1440 1440w',
                        ],
                        [
                            'auto' => 'format',
                            'q' => 85,
                            'fit' => 'max',
                            'w' => '1800 1800w',
                        ],
                        [
                            'auto' => 'format',
                            'q' => 85,
                            'fit' => 'max',
                            'w' => '2600 2600w',
                        ],
                    ],
                ],
            ],
        ],
    ];

    const CROPS = [
        //для svg, без возможности кропа
        'icon'=>[
            'default'=>[
                   [
                        'name' => 'default',
                        'ratio' => null,
                    ]
                ]
            ],
        'icon_mobile'=>[
            'default'=>[
                [
                    'name' => 'default',
                    'ratio' => null,
                ]
            ]
        ],
        'og_image' => [
            'default' => [
                [
                    'name' => 'jpg',
                    'ratio' => null,
                ],
            ],
        ],
        'video_cover'=>[
            'desktop' => [
                [
                    'name' => 'jpg',
                    'ratio' => 1120 / 550,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>1,
                                        'h'=> '550',
                                        'w' => ' 1x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>2,
                                        'h'=> '550',
                                        'w' => ' 2x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>4,
                                        'h'=> '550',
                                        'w' => ' 4x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>8,
                                        'h'=> '550',
                                        'w' => ' 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => 1120/ 550,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>1,
                                        'h'=> '550',
                                        'w' => ' 1x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>2,
                                        'h'=> '550',
                                        'w' => ' 2x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>4,
                                        'h'=> '550',
                                        'w' => ' 4x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>8,
                                        'h'=> '550',
                                        'w' => ' 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'mobile' => [
                [
                    'name' => 'jpg',
                    'ratio' => 288 / 200,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>1,
                                        'w' => '500 1x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>2,
                                        'w' => '500 2x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>4,
                                        'w' => '500 4x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>8,
                                        'w' => '500 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => 288/ 200,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>1,
                                        'w' => '500 1x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>2,
                                        'w' => '500 2x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>4,
                                        'w' => '500 4x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>8,
                                        'w' => '500 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'article_image'=>[
            'desktop' => [
                [
                    'name' => 'jpg',
                    'ratio' => 1120 / 440,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>1,
                                        'h'=> '500',
                                        'w' => ' 1x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>2,
                                        'h'=> '500',
                                        'w' => ' 2x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>4,
                                        'h'=> '500',
                                        'w' => ' 4x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>8,
                                        'h'=> '500',
                                        'w' => ' 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => 1120/ 440,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>1,
                                        'h'=> '500',
                                        'w' => ' 1x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>2,
                                        'h'=> '500',
                                        'w' => ' 2x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>4,
                                        'h'=> '500',
                                        'w' => ' 4x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>8,
                                        'h'=> '500',
                                        'w' => ' 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'mobile' => [
                [
                    'name' => 'jpg',
                    'ratio' => 288 / 290,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>1,
                                        'w' => '500 1x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>2,
                                        'w' => '500 2x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>4,
                                        'w' => '500 4x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>8,
                                        'w' => '500 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => 288/ 290,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>1,
                                        'w' => '500 1x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>2,
                                        'w' => '500 2x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>4,
                                        'w' => '500 4x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>8,
                                        'w' => '500 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'section_homepage_projects_image'=>[
            'desktop' => [
                [
                    'name' => 'jpg',
                    'ratio' => 150 / 155,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>1,
                                        'h'=> '155',
                                        'w' => '142 1x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>2,
                                        'h'=> '155',
                                        'w' => '142 2x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>4,
                                        'h'=> '155',
                                        'w' => '142 4x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>8,
                                        'h'=> '155',
                                        'w' => '142 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => 150 / 155,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>1,
                                        'h'=> '155',
                                        'w' => '142 1x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>2,
                                        'h'=> '155',
                                        'w' => '142 2x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>4,
                                        'h'=> '155',
                                        'w' => '142 4x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>8,
                                        'h'=> '155',
                                        'w' => '142 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'mobile' => [
                [
                    'name' => 'jpg',
                    'ratio' => 150 / 155,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>1,
                                        'h'=> '155',
                                        'w' => '142 1x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>2,
                                        'h'=> '155',
                                        'w' => '142 2x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>4,
                                        'h'=> '155',
                                        'w' => '142 4x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>8,
                                        'h'=> '155',
                                        'w' => '142 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => 150 / 155,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>1,
                                        'h'=> '155',
                                        'w' => '142 1x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>2,
                                        'h'=> '155',
                                        'w' => '142 2x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>4,
                                        'h'=> '155',
                                        'w' => '142 4x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>8,
                                        'h'=> '155',
                                        'w' => '142 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'section_homepage_banner_image'=>[
            'desktop' => [
                [
                    'name' => 'jpg',
                    'ratio' => 150 / 155,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>1,
                                        'h'=> '155',
                                        'w' => '142 1x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>2,
                                        'h'=> '155',
                                        'w' => '142 2x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>4,
                                        'h'=> '155',
                                        'w' => '142 4x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>8,
                                        'h'=> '155',
                                        'w' => '142 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => 150 / 155,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>1,
                                        'h'=> '155',
                                        'w' => '142 1x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>2,
                                        'h'=> '155',
                                        'w' => '142 2x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>4,
                                        'h'=> '155',
                                        'w' => '142 4x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>8,
                                        'h'=> '155',
                                        'w' => '142 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'mobile' => [
                [
                    'name' => 'jpg',
                    'ratio' => 150 / 155,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>1,
                                        'h'=> '155',
                                        'w' => '142 1x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>2,
                                        'h'=> '155',
                                        'w' => '142 2x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>4,
                                        'h'=> '155',
                                        'w' => '142 4x',
                                    ],
                                    [
                                        'fm'=>'jpg',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>8,
                                        'h'=> '155',
                                        'w' => '142 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => 150 / 155,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>1,
                                        'h'=> '155',
                                        'w' => '142 1x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>2,
                                        'h'=> '155',
                                        'w' => '142 2x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>4,
                                        'h'=> '155',
                                        'w' => '142 4x',
                                    ],
                                    [
                                        'fm'=>'webp',
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr'=>8,
                                        'h'=> '155',
                                        'w' => '142 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        //Баннер топ для article
        'article_banner' => [
            'desktop' => [
                [
                    'name' => 'jpg',
                    'ratio' => 1280/500,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'jpg',
                                        'h'=> '500 1x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'jpg',
                                        'h'=> '500 2x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 4,
                                        'fm' => 'jpg',
                                        'h'=> '500 4x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 8,
                                        'fm' => 'jpg',
                                        'h'=> '500 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => 1280/500,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'webp',
                                        'h'=> '500 1x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'webp',
                                        'h'=> '500 2x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 4,
                                        'fm' => 'webp',
                                        'h'=> '500 4x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 8,
                                        'fm' => 'webp',
                                        'h'=> '500 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'tablet' => [
                [
                    'name' => 'jpg',
                    'ratio' => 1024/400,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'jpg',
                                        'h'=> '400 1x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'jpg',
                                        'h'=> '400 2x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 4,
                                        'fm' => 'jpg',
                                        'h'=> '400 4x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 8,
                                        'fm' => 'jpg',
                                        'h'=> '400 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => 1024/400,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'webp',
                                        'h'=> '400 1x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'webp',
                                        'h'=> '500 2x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 4,
                                        'fm' => 'webp',
                                        'h'=> '500 4x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 8,
                                        'fm' => 'webp',
                                        'h'=> '500 8x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'mobile' => [
                [
                    'name' => 'jpg',
                    'ratio' => 320 / 400,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 90,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'jpg',
                                        'h'=>'400 1x'
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 90,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'jpg',
                                        'h'=>'400 2x'
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 90,
                                        'fit' => 'max',
                                        'dpr' => 4,
                                        'fm' => 'jpg',
                                        'h'=>'400 4x'
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 90,
                                        'fit' => 'max',
                                        'dpr' => 8,
                                        'fm' => 'jpg',
                                        'h'=>'400 8x'
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => 320 / 400,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 90,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'webp',
                                        'h'=>'400 1x'
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 90,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'webp',
                                        'h'=>'400 2x'
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 90,
                                        'fit' => 'max',
                                        'dpr' => 4,
                                        'fm' => 'webp',
                                        'h'=>'400 4x'
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 90,
                                        'fit' => 'max',
                                        'dpr' => 8,
                                        'fm' => 'webp',
                                        'h'=>'400 8x'
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        //Баннер топ
        'banner_image' => [
            'desktop' => [
                [
                    'name' => 'jpg',
                    'ratio' => 1120 / 350,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'jpg',
                                        'h'=> '804 1x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'jpg',
                                        'h'=> '804 2x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => 1120 / 350,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'webp',
                                        'h'=> '804 1x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'webp',
                                        'h'=> '804 2x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'mobile' => [
                [
                    'name' => 'jpg',
                    'ratio' => 400 / 360,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'jpg',
                                        'h'=>'360 1x'
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'jpg',
                                        'h'=>'360 2x'
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => 400 / 360,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'webp',
                                        'h'=>'360 1x'
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'webp',
                                        'h'=>'360 2x'
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'desktop_v2' => [
                [
                    'name' => 'jpg',
                    'ratio' => 0,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'jpg',
                                        'h'=> '804 1x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'jpg',
                                        'h'=> '804 2x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => 0,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'webp',
                                        'h'=> '804 1x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 95,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'webp',
                                        'h'=> '804 2x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'mobile_v2' => [
                [
                    'name' => 'jpg',
                    'ratio' => 390 / 360,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'jpg',
                                        'h'=>'360 1x'
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'jpg',
                                        'h'=>'360 2x'
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => 0,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'webp',
                                        'h'=>'360 1x'
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'webp',
                                        'h'=>'360 2x'
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        //Баннер новости
        'banner_image_news' => [
            'desktop' => [
                [
                    'name' => 'jpg',
                    'ratio' => 0,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'jpg',
                                        'h'=> '307 1x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'jpg',
                                        'h'=> '307 2x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => 0,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'webp',
                                        'h'=> '307 1x',
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'webp',
                                        'h'=> '307 2x',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'mobile' => [
                [
                    'name' => 'jpg',
                    'ratio' => 0,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'jpg',
                                        'h'=>'300 1x'
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'jpg',
                                        'h'=>'300 2x'
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => 0,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'webp',
                                        'h'=>'300 1x'
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'webp',
                                        'h'=>'300 2x'
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        //фотка на примерах продукта
        'example_image' => [
            'desktop' => [
                [
                    'name' => 'jpg',
                    'ratio' => null,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'jpg',
                                        'w'=>800
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'jpg',
                                        'w'=>800
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 4,
                                        'fm' => 'jpg',
                                        'w'=>800
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 8,
                                        'fm' => 'jpg',
                                        'w'=>800
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => null,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'webp',
                                        'w'=>800
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'webp',
                                        'w'=>800
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 4,
                                        'fm' => 'webp',
                                        'w'=>800
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 8,
                                        'fm' => 'webp',
                                        'w'=>800
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'mobile' => [
                [
                    'name' => 'jpg',
                    'ratio' => null,
                    'extra' => [
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'jpg',
                                        'w'=>640,
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'jpg',
                                        'w'=>640,
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 4,
                                        'fm' => 'jpg',
                                        'w'=>640,
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 8,
                                        'fm' => 'jpg',
                                        'w'=>640,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'webp',
                    'ratio' => null,
                    'extra' => [
                        'lqip' => ['w' => 15, 'fit' => 'max', 'auto' => 'format'],
                        'srcset' => [
                            [
                                '__glue' => ', ',
                                '__items' => [
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 1,
                                        'fm' => 'webp',
                                        'w'=>640,
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 2,
                                        'fm' => 'webp',
                                        'w'=>640,
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 4,
                                        'fm' => 'webp',
                                        'w'=>640,
                                    ],
                                    [
                                        'auto' => 'format',
                                        'q' => 85,
                                        'fit' => 'max',
                                        'dpr' => 8,
                                        'fm' => 'webp',
                                        'w'=>640,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];
}
