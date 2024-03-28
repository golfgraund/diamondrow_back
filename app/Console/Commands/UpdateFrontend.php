<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateFrontend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'almaz:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update frontend files in CMS';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Define the source directory path
        $sourceDirectory = base_path('frontend');

        // Define the destination directory path in the vendor directory
        $destinationDirectory = base_path('vendor/area17/twill/frontend');

        // Create the destination directory if it does not exist
        if (!File::exists($destinationDirectory)) {
            $this->error('Twill is not installed, try - composer require area17/twill:^2.0');
            return 0;
        }

        // Recursively copy the files and directories
        File::copyDirectory($sourceDirectory, $destinationDirectory);

        $this->info("The command was successful!");

        $this->call('twill:build');
    }
}
