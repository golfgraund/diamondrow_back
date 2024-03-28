<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Model;
use Illuminate\Support\Facades\Storage;

class Puzzle extends Model
{
    use HasSlug, HasFiles, HasMedias;

    protected $fillable = [
        'published',
        'title',
        'code_id',
        'customer_id',
        'matrix_progress',
    ];

    public $slugAttributes = [
        'title',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function codes()
    {
        return $this->belongsTo(PuzzleCode::class, 'code_id');
    }

    public function imageAsArr($role, $crop = "default")
    {
        $media = $this->findMedia($role, $crop);

        if ($media) {
            return ['src' => asset('/img/' . $media->uuid)];
        }

        return [];
    }

    public function storagePdfPath($useAppInPath = true): string
    {
        return $useAppInPath
            ? storage_path('app/public/uploads/files/puzzles/pdf/' . $this->title . '.pdf')
            : storage_path('public/uploads/files/puzzles/pdf/' . $this->title . '.pdf') ;
    }

    public function localPdfPath()
    {
        return 'public/uploads/files/puzzles/pdf/'. $this->title . '.pdf';
    }


    public function storageHTMLPath($useAppInPath = true): string
    {
        return $useAppInPath
            ? storage_path('app/public/uploads/files/puzzles/html/' . $this->title . '.html')
            : storage_path('public/uploads/files/puzzles/html/' . $this->title . '.html');
    }

    public function localHTMLPath(): string
    {
        return 'public/uploads/files/puzzles/html/' . $this->title . '.html';
    }
}
