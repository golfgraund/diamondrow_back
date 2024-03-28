<?php

namespace App\Repositories;

use A17\Twill\Repositories\ModuleRepository;
use App\Models\Customer;
use Illuminate\Support\Str;

class CustomerRepository extends ModuleRepository
{
    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    /**
     * Fix this method
     */
    public function getByRequest($request)
    {
        $puzzleCodeQuery = $this->model->newQuery();

        if (isset($request->date)) {
            $date = Str::of($request->date)->explode(' — ');

            $date->first() != $date->last()
                ? $puzzleCodeQuery->whereBetween('created_at', [$date->first(), $date->last()])
                : $puzzleCodeQuery->whereDate('created_at', $date->first());
        }

        $puzzleCodeQuery->orderByDesc('id');

        return $puzzleCodeQuery->get();
    }

    public function getUniquesCode(): string
    {
        $code = mb_strtoupper(Str::random(4));

        if ($this->model->newQuery()->where('mail_code', $code)->first()) {
            return $this->getUniquesCode();
        }

        return $code;
    }
}
