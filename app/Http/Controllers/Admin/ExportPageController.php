<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Helpers\FlashLevel;
use A17\Twill\Http\Controllers\Admin\Controller;
use App\Exports\InvoicesExport;
use App\Repositories\CustomerRepository;
use App\Repositories\PuzzleCodeRepository;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Browsershot\Browsershot;

class ExportPageController extends Controller
{
    public function show(Request $request, $code)
    {
        $data = [
            'form_fields' => [],
            'form_action_url' => route('admin.exportPage.show', ['code' => $code]),
            'color' => [
                'options' => [
                    ['label' => 'Черно-белый', 'value' => 'blackAndWhite'],
                    ['label' => 'Сепия', 'value' => 'sepia'],
                    ['label' => 'Поп-арт', 'value' => 'popArt']
                ]
            ],
            'size' => [
                'options' => [
                    ['label' => '30x40 см', 'value' => '30x40'],
                    ['label' => '20x30 см', 'value' => '20x30'],
                    ['label' => '40x50 см', 'value' => '40x50'],
                ]
            ],
            'doc_ext' => [
                'selected' => 'pdf',
                'options' => [
                    ['label' => 'PDF', 'value' => 'pdf'],
                    ['label' => 'XLS', 'value' => 'xslx']
                ]
            ],
            'error' => [
                'message' => $request->get('error') ?? ''
            ],
        ];

        return view()->exists('admin.exportPage.' . $code)
            ? view('admin.exportPage.' . $code, $data)
            : abort(404);
    }

    public function exportCodes(Request $request)
    {
        $puzzleRepository = app()->make(PuzzleCodeRepository::class);
        $puzzleCode = $puzzleRepository->getByRequest($request);

        if (!$puzzleCode->count()) {
            return redirect(route($request->route()->getName()) . '?error=empty');
        }

        return match ($request->doc_ext) {
            'xslx' => $this->exportExcel(
                $puzzleCode,
                [
                    'id' => ['label' => 'ID'],
                    'code' => ['label' => 'Код'],
                    'color' => ['label' => 'Цвет', 'alt_titles' => $puzzleRepository->colorCodes],
                    'size' => ['label' => 'Размер'],
                    'created_at' => ['label' => 'Дата', 'type' => 'date'],
                ],
                'puzzle_codes' . '_' . date('d-m-Y'),
                true
            ),
            'pdf' => $this->exportPDF($puzzleCode, 'puzzle_codes'),
            default => $this->respondWithError('Возникла с расширением файла!'),
        };
    }

    public function exportCustomers(Request $request)
    {
        $puzzleCode = app()->make(CustomerRepository::class)->getByRequest($request);

        if (!$puzzleCode->count()) {
            return redirect(route($request->route()->getName()) . '?error=empty');
        }

        if ($puzzleCode) {
            return $this->exportExcel(
                $puzzleCode,
                ['id' => ['label' => 'ID'], 'email' => ['label' => 'Email']],
                'mail_codes' . '_' . date('d-m-Y'),
                true
            );
        }

        return $this->respondWithError('Возникла ошибка!');
    }

    /**
     * [
     *  'property_code' => [
     *      'label' => 'id'
     *      'alt_titles' => ['code' => 'value'],
     *      'type' => 'date/string'
     *   ]
     * ]
     */
    public function exportExcel(Collection $source, array $fields, string $fileName, bool $respondWithRedirect = false)
    {
        Excel::store(
            new InvoicesExport(array_merge([array_column($fields, 'label')], $source->map(function ($item) use ($fields) {
                return collect($fields)->map(function ($field, $key) use ($item) {
                    if (isset($field['alt_titles'])) {
                        return $field['alt_titles'][$item->$key];
                    }

                    if (isset($field['type']) && $field['type'] == 'date') {
                        return Carbon::parse($item->$key)->format('d.m.Y');
                    }

                    return $item->$key;
                })->values()->toArray();
            })->toArray())),
            "$fileName.xls", 'public'
        );

        return $respondWithRedirect
            ? response()->download(public_path() . "/storage/$fileName.xls")->deleteFileAfterSend()
            : route('api.medias.excel', ['file' => $fileName]);
    }

    public function exportPDF(Collection $source, string $fileName)
    {
        $savePath = storage_path('app/public/' . $fileName . '_' . date('d-m-Y') . '.pdf');

        ini_set('memory_limit', '256M');

        Browsershot::html(view('pdf.export-codes', ['itemsChunks' => $source->chunk(4)])->render())
            ->format('A4')
            ->setOption('args', ['--disable-web-security', '--no-sandbox'])
            ->addChromiumArguments([
                'font-render-hinting' => 'none',
            ])
            ->waitUntilNetworkIdle()
            ->ignoreHttpsErrors()
            ->save($savePath);

        return response()->download($savePath)->deleteFileAfterSend();
    }

    protected function respondWithJson($message, $variant): JsonResponse
    {
        return Response::json([
            'message' => $message,
            'variant' => $variant,
        ]);
    }

    protected function respondWithError($message): JsonResponse
    {
        return $this->respondWithJson($message, FlashLevel::ERROR);
    }
}
