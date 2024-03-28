<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PuzzleCodeController extends ModuleController
{
    protected $moduleName = 'puzzleCode';

    protected $titleColumnKey = 'code';

    protected $defaultOrders = ['id' => 'desc'];

    protected $indexOptions = [
        'create' => true,
        'edit' => false,
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
        'bulkEdit' => true,
        'editInModal' => false,
        'forceDelete' => false,
        'bulkForceDelete' => false,
    ];

    protected $indexColumns = [
        'id' => [
            'title' => 'ID',
            'field' => 'id',
            'sort' => true,
            'visible' => true,
        ],
        'code' => [
            'title' => 'Код',
            'field' => 'code',
            'sort' => true,
            'visible' => true,
        ],
        'color' => [
            'title' => 'Цвет',
            'field' => 'color',
            'sort' => true,
            'visible' => true,
        ],
        'size' => [
            'title' => 'Размер',
            'field' => 'size',
            'sort' => true,
            'visible' => true,
        ],
        'used_count' => [
            'title' => 'Кол-во использований',
            'field' => 'used_count',
            'sort' => true,
            'visible' => true,
        ],
        'created_at' => [
            'title' => 'Дата создания',
            'field' => 'created_at',
            'sort' => true,
            'visible' => true,
        ],
    ];

    public function index($parentModuleId = null)
    {
        $parentModuleId = $this->getParentModuleIdFromRequest($this->request) ?? $parentModuleId;

        $this->submodule = isset($parentModuleId);
        $this->submoduleParentId = $parentModuleId;

        $indexData = $this->getIndexData($this->submodule ? [
            $this->getParentModuleForeignKey() => $this->submoduleParentId,
        ] : []);

        if ($this->request->ajax()) {
            return $indexData + ['replaceUrl' => true];
        }

        if ($this->request->has('openCreate') && $this->request->get('openCreate')) {
            $indexData += ['openCreate' => true];
        }

        $indexData['bulkExportPDFUrl'] = route('admin.puzzleCodes.bulkExportPDF');
        $indexData['bulkExportXSLUrl'] = route('admin.puzzleCodes.bulkExportXLS');

        return view('admin.puzzleCode.index', $indexData);
    }

    public function additionalTableActions()
    {
        return [
            'exportFormAction' => [ // Action name.
                'name' => 'Экспорт', // Button action title.
                'variant' => 'primary', // Button style variant. Available variants; primary, secondary, action, editor, validate, aslink, aslink-grey, warning, ghost, outline, tertiary
                'size' => 'small', // Button size. Available sizes; small
                'link' => route('admin.exportPage.code'), // Button action link.
                'target' => '',
                'type' => 'a',
            ]
        ];
    }

    public function store($parentModuleId = null)
    {
        $parentModuleId = $this->getParentModuleIdFromRequest($this->request) ?? $parentModuleId;

        $input = $this->validateFormRequest()->all();

        $optionalParent = $parentModuleId ? [$this->getParentModuleForeignKey() => $parentModuleId] : [];

        if (isset($input['cmsSaveType']) && $input['cmsSaveType'] === 'cancel') {
            return $this->respondWithRedirect(moduleRoute(
                $this->moduleName,
                $this->routePrefix,
                'create'
            ));
        }

        collect(range(1, $input['count']))->map(function () use ($input, $optionalParent) {
            $item = $this->repository->create($input + $optionalParent + ['code' => $this->repository->generateUniqueRandomCode()]);

            activity()->performedOn($item)->log('created');
        });

        $this->fireEvent($input);

        Session::put($this->moduleName . '_retain', true);

        if ($this->getIndexOption('editInModal')) {
            return $this->respondWithSuccess(twillTrans('twill::lang.publisher.save-success'));
        }

        if (isset($input['cmsSaveType']) && Str::endsWith($input['cmsSaveType'], '-close')) {
            return $this->respondWithRedirect($this->getBackLink());
        }

        if (isset($input['cmsSaveType']) && Str::endsWith($input['cmsSaveType'], '-new')) {
            return $this->respondWithRedirect(moduleRoute(
                $this->moduleName,
                $this->routePrefix,
                'create'
            ));
        }

        return $this->respondWithRedirect(route('admin.puzzleCode.index'));
    }

    protected function indexItemData($item)
    {
        return [
            'created_at' => $item->created_at->format('Y-m-d H:i'),
            'color' => $this->repository->colorCodes[$item->color]
        ];
    }

    public function bulkExportPDF()
    {
        $puzzleCodes = $this->repository->getById(explode(',', $this->request->get('ids')));

        if ($puzzleCodes) {
            return app()->make(ExportPageController::class)->exportPDF($puzzleCodes, 'puzzle_codes');
        }

        return $this->respondWithError(twillTrans('twill::lang.listing.bulk-delete.error', ['modelTitle' => $this->modelTitle]));
    }

    public function bulkExportXLS()
    {
        $puzzleCodes = $this->repository->getById(explode(',', $this->request->get('ids')));

        if ($puzzleCodes) {
            return app()
                ->make(ExportPageController::class)
                ->exportExcel($puzzleCodes, [
                    'id' => ['label' => 'ID'],
                    'code' => ['label' => 'Код'],
                    'color' => ['label' => 'Цвет', 'alt_titles' => $this->repository->colorCodes],
                    'size' => ['label' => 'Размер'],
                    'created_at' => ['label' => 'Дата', 'type' => 'date'],
                ], 'puzzle_codes');
        }

        return $this->respondWithError(twillTrans('twill::lang.listing.bulk-delete.error', ['modelTitle' => $this->modelTitle]));
    }
}
