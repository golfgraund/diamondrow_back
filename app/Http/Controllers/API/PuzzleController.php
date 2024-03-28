<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\PuzzlePutRequest;
use App\Http\Requests\API\PuzzleRequest;
use App\Models\Puzzle;
use App\Models\PuzzleCode;
use App\Repositories\PuzzleRepository;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Schema(
 *   schema="puzzle_get",
 *   example={
 *      "matrix_progress": {{"r":2, "g":3, "b":3, "fill": true}},
 *        "image": {
 *          "src": "http://almaz.loc/img/puzzles/oeUSAyr60pLhgc2jFWqZvZ7SwwTh7GYgSRu4AM3k.jpg"
 *   }}
 * ),
 * @OA\Schema(
 *   schema="puzzle_create",
 *   example={
 *     "email":"admin@mail.ru",
 *     "code":"VDR-XZT-IAN",
 *     "matrix_progress": "{{r:2, g:3, b:3, fill: true}}",
 *     "preview_picture": "Превью изображение для первой страницы",
 *     "preview_picture_type": "wide/tall - Растянуть изображение по ширине(wide)/высоте(tall)",
 *     "picture_colors": "Картинка с используемыми цветами для pdf",
 *   }
 * ),
 * @OA\Schema(
 *   schema="puzzle_update",
 *   example={
 *     "matrix_progress":"[{r:2, g:3, b:3, fill: true}] - сектор",
 *     "slug":"6866d58d9147e963e53234a367d5eadf",
 *     "sector_index": 0
 *   }
 * ),
 * * @OA\Schema(
 *   schema="puzzle_create_resp",
 *   example={
 *     "slug": "e7aeca86646e61ed47851c8764ea5625",
 *     "attempts_counter": 5,
 *     "pdf": {
 *        "src": "http://almaz.loc/storage/uploads/files/puzzles/pdf/e7aeca86646e61ed47851c8764ea5625.pdf"
 *      },
 *   }
 * ),
 */
class PuzzleController extends Controller
{
    protected string $repositoryClass = PuzzleRepository::class;

    protected PuzzleRepository $repository;

    public function __construct(PuzzleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @OA\Post(
     *      path="/api/puzzle/create",
     *      operationId="PuzzleCreate",
     *      tags={"POST"},
     *      summary="Создать мозаику + отправить на почту инструкцию",
     *      @OA\RequestBody (
     *           required=true,
     *           @OA\MediaType(
     *               mediaType="application/json",
     *               @OA\Schema(ref="#/components/schemas/puzzle_create"),
     *           )
     *       ),
     *      @OA\Response(
     *           response=201,
     *           description="Oк",
     *           @OA\MediaType(
     *               mediaType="application/json",
     *               @OA\Schema(ref="#/components/schemas/puzzle_create_resp"),
     *           )
     *       ),
     *       @OA\Response(
     *           response=422,
     *           description="Неправильный параметр"
     *        )
     *     )
     */
    public function create(PuzzleRequest $request)
    {
        $validatedFields = $request->validated();
        $puzzleCode = PuzzleCode::query()->where('code', $validatedFields['code'])->first();

        if (!$puzzleCode) {
            return response(['status' => 'error', 'response' => ['code' => ['Кода не существует']]], 422);
        }

        //Change on prod
        if ($puzzleCode->used_count >= env('ATTEMPTS_CODE_COUNT', 5)) {
            return response(['status' => 'error', 'response' => ['code' => ['Код использован максимальное число раз']]], 422);
        }

        $puzzle = $this->repository->createByValidFieldsAndPuzzleCode($validatedFields, $puzzleCode);

        unset($validatedFields['matrix_progress']);

        $puzzleCode->increment('used_count');

        return response()->json([
            'slug' => $puzzle->slug,
            'attempts_counter' => $puzzleCode->used_count >= env('ATTEMPTS_CODE_COUNT', 5) ? 0 : env('ATTEMPTS_CODE_COUNT', 5) - $puzzleCode->used_count,
            'pdf' => ['src' => route('api.medias.pdf', ['path' => $puzzle->slug])],
        ])->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      path="/api/puzzle/{slug}",
     *      tags={"GET"},
     *      operationId="PuzzleShow",
     *      summary="Получить данные мозаики",
     *      @OA\Parameter(
     *           name="slug",
     *           description="slug мозаики",
     *           required=true,
     *           in="path",
     *           example="6866d58d9147e963e53234a367d5eadf",
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Oк",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/puzzle_get"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Элемент не найден"
     *      ),
     *)
     */
    public function show($slug)
    {
        $puzzle = Puzzle::query()->forSlug($slug)->firstOrFail();

        return [
            'matrix_progress' => Storage::disk('local')->exists($puzzle->matrix_progress)
                ? json_encode(trim(Storage::disk('local')->get($puzzle->matrix_progress)))
                : null,
            'image' => $puzzle->imageAsArr('customer_image'),
        ];
    }

    /**
     * @OA\Post(
     *      path="/api/puzzle/update",
     *      operationId="PuzzleUpdate",
     *      tags={"POST"},
     *      summary="Обновить мозаику",
     *      @OA\RequestBody (
     *            required=true,
     *            @OA\MediaType(
     *                mediaType="application/json",
     *                @OA\Schema(ref="#/components/schemas/puzzle_update"),
     *            )
     *        ),
     *      @OA\Response(
     *          response=204,
     *          description="Успешно обновлено"
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Неправильный параметр"
     *       )
     *     )
     *
     * Returns list of products
     */
    public function update(PuzzlePutRequest $request)
    {
        $validatedFields = $request->validated();
        $puzzle = Puzzle::query()->forSlug($validatedFields['slug'])->first();

        if (!$puzzle) {
            return response(['status' => 'error', 'response' => ['code' => ['Такого элемента не существует']]], 422);
        }

        if (!Storage::disk('local')->exists($puzzle->matrix_progress)) {
            return response(['status' => 'error', 'response' => ['matrix_code' => ['Матрицы не существует']]], 500);
        }

        $matrix = json_decode(Storage::disk('local')->get($puzzle->matrix_progress));

        if (!isset($matrix[$validatedFields['sector_index']])) {
            return response(['status' => 'error', 'response' => ['matrix_code' => ['Ошибочный sector_index']]], 422);
        }

        $matrix[$validatedFields['sector_index']] = json_decode($validatedFields['matrix_progress']);

        //Update matrix file
        $this->repository->saveMatrix($puzzle->matrix_progress, json_encode($matrix));

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }

    public function isJsonResult(): bool
    {
        return true;
    }

    public function extractJsonData($data)
    {
        return $data;
    }
}
