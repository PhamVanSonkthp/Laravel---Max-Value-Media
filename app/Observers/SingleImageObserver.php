<?php

namespace App\Observers;

use App\Models\SingleImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class SingleImageObserver
{
    /**
     * Handle the SingleImage "created" event.
     *
     * @param  \App\Models\SingleImage $singleImage
     * @return void
     */
    public function created(SingleImage $singleImage)
    {
        //
    }

    /**
     * Handle the SingleImage "updated" event.
     *
     * @param  \App\Models\SingleImage  $singleImage
     * @return void
     */
    public function updated(SingleImage $singleImage)
    {

        if ($singleImage->isDirty('image_path')) {
            $oldImagePath = $singleImage->getOriginal('image_path');

            if ($oldImagePath != "waiting_update") {
                try {
                    $paths = explode("/", $oldImagePath);
                    $path = $paths[1] . "/" . $paths[2] . "/" . $paths[3] . "/" . $paths[4] . "/" . "original" . "/" . $paths[6];
                    File::delete(storage_path($path));

                    foreach (config('_images_cut_sizes.sizes') as $size) {
                        $path = $paths[1] . "/" . $paths[2] . "/" . $paths[3] . "/" . $paths[4] . "/" . $size . "/" . $paths[6];
                        File::delete(storage_path($path));
                    }
                } catch (\Exception $exception) {
                    Log::error($exception);
                }
            }
        }
    }

    /**
     * Handle the SingleImage "deleted" event.
     *
     * @param  \App\Models\SingleImage  $singleImage
     * @return void
     */
    public function deleted(SingleImage $singleImage)
    {
        //
    }

    /**
     * Handle the SingleImage "restored" event.
     *
     * @param  \App\Models\SingleImage  $singleImage
     * @return void
     */
    public function restored(SingleImage $singleImage)
    {
        //
    }

    /**
     * Handle the SingleImage "force deleted" event.
     *
     * @param  \App\Models\SingleImage  $singleImage
     * @return void
     */
    public function forceDeleted(SingleImage $singleImage)
    {
        //
    }
}
