<?php

namespace App\Repositories;

use A17\Twill\Models\Media;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleFiles;
use A17\Twill\Repositories\ModuleRepository;
use App\Jobs\PdfPuzzleJob;
use App\Models\Customer;
use App\Models\Puzzle;
use App\Models\PuzzleCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PuzzleRepository extends ModuleRepository
{
    use HandleSlugs, HandleFiles, HandleMedias;

    public function __construct(Puzzle $model)
    {
        $this->model = $model;
    }

    public function attachImage($imageFile, $puzzle, $role)
    {
        $imageFileName = Storage::disk('local')->put('public/uploads/images/puzzles', $imageFile);

        $media = new Media([
            'uuid' => 'puzzles/' . basename($imageFileName),
            'filename' => basename($imageFileName),
            'caption' => 'Image Caption',
            'alt_text' => 'Image Alt Text',
            'width' => 0,
            'height' => 0,
            'crop' => [],
            'mime_type' => $imageFile->getClientMimeType(),
            'size' => $imageFile->getSize(),
        ]);

        $media->save();

        $puzzle->medias()->attach($media->id, [
            'role' => $role,
            'metadatas' => '{}',
            'crop' => 'default',
            'mediable_id' => $puzzle->id
        ]);

        $puzzle->save();
    }

    public function generateUniqueSlug(): string
    {
        $slug = md5(time() . Str::random(3));

        if ($this->model->newQuery()->where('title', $slug)->first()) {
            return $this->generateUniqueSlug();
        }

        return $slug;
    }

    public function createByValidFieldsAndPuzzleCode(array $validatedFields, PuzzleCode $puzzleCode)
    {
        $customer = Customer::firstOrCreate(['published' => true, 'email' => $validatedFields['email']]);
        $uniqueSlug = $this->generateUniqueSlug();

        //Create puzzle
        $puzzle = $this->create([
            'title' => $uniqueSlug,
            'published' => true,
            'code_id' => $puzzleCode->id,
            'customer_id' => $customer->id,
            'matrix_progress' => "puzzles/matrices/$uniqueSlug.json",
        ]);

        //Attach images
        $this->attachImage($validatedFields['preview_picture'], $puzzle, 'customer_image');
        $this->attachImage($validatedFields['picture_colors'], $puzzle, 'colors_image');

        //Save matrix
        $this->saveMatrix($puzzle->matrix_progress, $validatedFields['matrix_progress']);

        //Save html
        Storage::disk('local')->put(
            $puzzle->localHTMLPath(),
            view('pdf.customer', [
                'puzzle' => $puzzle,
                'previewType' => $validatedFields['preview_picture_type'],
                'matrix' => collect(json_decode($validatedFields['matrix_progress']))->chunk(9),
                'imageColorsSrc' => $validatedFields['picture_colors']->getPathname(),
                'qrCodeSVG' => QrCode::format('svg')->style('round', 0.9)->size(68)->generate(route('web.puzzle.show', ['slug' => $puzzle->slug])),
            ])->render()
        );

        //Create PDF file with delay
        PdfPuzzleJob::dispatch($puzzle->slug)->delay(now()->addSeconds(3));

        return $puzzle;
    }

    public function saveMatrix(string $path, $matrix)
    {
        Storage::disk('local')->put($path, $matrix);
    }
}
