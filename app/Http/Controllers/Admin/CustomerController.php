<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;

class CustomerController extends BaseModuleController
{
    protected $moduleName = 'customers';

    protected $titleColumnKey = 'email';

    protected $defaultOrders = ['id' => 'desc'];

    protected $indexOptions = [
        'create' => false,
        'edit' => true,
        'publish' => false,
        'bulkPublish' => false,
        'feature' => false,
        'bulkFeature' => false,
        'restore' => false,
        'bulkRestore' => false,
        'delete' => false,
        'bulkDelete' => false,
        'reorder' => false,
        'permalink' => false,
        'bulkEdit' => false,
        'editInModal' => false,
        'forceDelete' => false,
        'bulkForceDelete' => false,
    ];

    protected $indexColumns = [
        'email' => [
            'title' => 'Почта',
            'field' => 'email',
            'sort' => true,
            'visible' => true,
        ],
        'created_at' => [
            'title' => 'Дата создания',
            'field' => 'created_at',
            'sort' => true,
            'visible' => true,
        ],
        'id' => [
            'title' => 'ID',
            'field' => 'id',
            'sort' => true,
            'visible' => true,
        ],
    ];

    public function additionalTableActions()
    {
        return [
            'exportMailAction' => [ // Action name.
                'name' => 'Экспорт', // Button action title.
                'variant' => 'primary', // Button style variant. Available variants; primary, secondary, action, editor, validate, aslink, aslink-grey, warning, ghost, outline, tertiary
                'size' => 'small', // Button size. Available sizes; small
                'link' => route('admin.exportPage.customer'), // Button action link.
                'target' => '',
                'type' => 'a',
            ]
        ];
    }

    protected function indexItemData($item)
    {
        return ['created_at' => $item->created_at->format('Y-m-d H:i')];
    }
}
