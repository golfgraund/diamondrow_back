<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class PuzzleController extends Controller
{
    public function show($slug)
    {
        return response()->noContent();
    }
}
