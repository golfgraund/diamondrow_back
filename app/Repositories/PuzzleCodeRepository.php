<?php

namespace App\Repositories;

use A17\Twill\Repositories\ModuleRepository;
use App\Models\PuzzleCode;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PuzzleCodeRepository extends ModuleRepository
{
    public array $colorCodes = [
        'blackAndWhite' => 'Чёрно-белый',
        'sepia' => 'Сепия',
        'popArt' => 'Поп-арт',
    ];

    public function __construct(PuzzleCode $model)
    {
        $this->model = $model;
    }

    public function generateUniqueRandomCode(int $charsCount = 9): string
    {
        $code = implode('-', str_split(mb_strtoupper(Str::random($charsCount)), 3));;

        if ($this->model->newQuery()->where('code', $code)->first()) {
            return $this->generateUniqueRandomCode();
        }

        return $code;
    }

    /**
     * Fix this method
     */
    public function getByRequest($request)
    {
        $puzzleCodeQuery = $this->model->newQuery();

        if (isset($request->color)) {
            $puzzleCodeQuery->whereIn('color', $request->color);
        }

        if (isset($request->size)) {
            $puzzleCodeQuery->whereIn('size', $request->size);
        }

        if (isset($request->date)) {
            $date = Str::of($request->date)->explode(' — ');

            $date->first() != $date->last()
                ? $puzzleCodeQuery->whereBetween('created_at', [$date->first(), $date->last()])
                : $puzzleCodeQuery->whereDate('created_at', $date->first());
        }

        $puzzleCodeQuery->orderByDesc('id');

        return $puzzleCodeQuery->get();
    }
}
