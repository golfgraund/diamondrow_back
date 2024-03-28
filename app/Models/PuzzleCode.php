<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Model;

class PuzzleCode extends Model
{
    protected $fillable = [
        'position',
        'code',
        'size',
        'color',
    ];

    public $colorCodes = [
        'blackAndWhite' => 'Чёрно-белый',
        'sepia' => 'Сепия',
        'popArt' => 'Поп-арт',
    ];
}
