<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PuzzleCodeRequest;
use App\Models\PuzzleCode;
use App\Repositories\PuzzleCodeRepository;

/**
 * @OA\Schema(
 *   schema="puzzle_code_verify",
 *   example={
 *      "code": "VDR-XZT-IAN",
 *   }
 * ),
 * @OA\Schema(
 *   schema="puzzle_code_verify_created",
 *   example={
 *      "status": "success",
 *      "response": {
 *          "code": {
 *              "Введен корректный код"
 *          }
 *      },
 *      "color": "popArt",
 *      "size": "20x30"
 *  }
 * )
 */
class PuzzleCodeController extends Controller
{
    protected string $repositoryClass = PuzzleCodeRepository::class;

    protected PuzzleCodeRepository $repository;

    public function __construct(PuzzleCodeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @OA\Post(
     *      path="/api/puzzle-codes/verify",
     *      operationId="verify",
     *      tags={"POST"},
     *      summary="Проверить код",
     *      @OA\RequestBody (
     *           required=true,
     *           @OA\MediaType(
     *               mediaType="application/json",
     *               @OA\Schema(ref="#/components/schemas/puzzle_code_verify"),
     *           )
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Элемент создан",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/puzzle_code_verify_created"),
     *          )
     *       ),
     *       @OA\Response(
     *           response=422,
     *           description="Неправильный параметр"
     *        )
     *     )
     */
    public function verify(PuzzleCodeRequest $request)
    {
        $validatedFields = $request->validated();

        $puzzleCode = PuzzleCode::query()->where('code', $validatedFields['code'])->first();

        if (!$puzzleCode) {
            return response([
                'status' => 'error',
                'response' => ['code' => ['Введен неверный код']]
            ], 422);
        }

        if ($puzzleCode->used_count >= env('ATTEMPTS_CODE_COUNT', 5)) {
            return response(['status' => 'error', 'response' => ['code' => ['Код использован максимальное число раз']]], 422);
        }

        return [
            'status' => 'success',
            'response' => ['code' => ['Введен корректный код']],
            'color' => $puzzleCode->color,
            'size' => $puzzleCode->size,
        ];
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
