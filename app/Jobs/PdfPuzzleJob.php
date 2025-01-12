<?php

namespace App\Jobs;

use App\Repositories\PuzzleRepository;
use App\Services\PDF\PDFService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PdfPuzzleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public $puzzleSlug)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(PDFService $service)
    {
        $service->createPuzzlePDF($this->puzzleSlug);
    }
}
