<?php

namespace App\Services\PDF;

use App\Mail\MailPuzzle;
use App\Models\Puzzle;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;

class PDFService
{
    /**
     * @var void
     */
    public function __construct()
    {
    }

    public function createPuzzlePDF($slug)
    {
        ini_set('memory_limit', '256M');

        $puzzle = Puzzle::query()->forSlug($slug)->firstOrFail();

        $time_start = microtime(true);

        //Create PDf
        Browsershot::htmlFromFilePath($puzzle->storageHTMLPath())
            ->format('A4')
            ->setOption('args', ['--disable-web-security', '--no-sandbox', '--disable-setuid-sandbox'])
            ->ignoreHttpsErrors()
            ->save($puzzle->storagePdfPath());

        //Send mail
        Mail::send(new MailPuzzle(
            [$puzzle->customers()->first()->email, env('MAIL_ADMIN', 'max.litwinowarriors@gmail.com')],
            ['puzzle' => $puzzle], $puzzle
        ));

        //Remove html
        if (Storage::exists($puzzle->localHTMLPath())) {
            Storage::delete($puzzle->localHTMLPath());
        }

        //Logging
        Log::debug($puzzle->customers()->first()->email, [
            'time_to_create_pdf' => number_format(microtime(true) - $time_start, 2) . " seconds.",
            'memory_usage' => ((memory_get_usage() / 1024) / 1024) . 'M',
        ]);
    }
}
