<?php

return [
    'puzzleCode' => [
        'title' => 'Коды',
        'module' => true
    ],
    'customers' => [
        'title' => 'Клиенты',
        'module' => true,
    ],
    'exportPage' => [
        'title' => 'Экспорт',
        'route' => 'admin.exportPage.code',
        'primary_navigation' => [
            'code' => [
                'title' => 'Коды',
                'route' => 'admin.exportPage.code',
            ],
            'mail' => [
                'title' => 'Клиенты',
                'route' => 'admin.exportPage.customer',
            ],
        ]
    ],
];
