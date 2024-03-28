<?php

namespace App\Models;

use A17\Twill\Models\Model;

class Customer extends Model
{
    protected $fillable = [
        'published',
        'email',
    ];

    public function puzzles()
    {
        return $this->hasMany(Puzzle::class);
    }
}
