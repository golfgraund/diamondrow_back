<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * @param $name
     * @return \Illuminate\Http\Response
     */
    public function showPdfFile($name): \Illuminate\Http\Response
    {
        $storagePath = 'public/uploads/files/puzzles/pdf/' . $name . '.pdf';

        if (!Storage::exists($storagePath)) {
            return Response::make('File no found.', 404);
        }

        return Response::make(Storage::get($storagePath))
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Content-type', Storage::mimeType($storagePath));
    }

    public function showExcelFile($name)
    {
        return response()->download(public_path() . '/storage/' . $name . '.xls')->deleteFileAfterSend();
    }
}
