<?php

namespace App\Observers;

use App\Models\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ImageObserver
{
    /**
     * Handle the Image "created" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function created(Image $image)
    {
        //
    }

    /**
     * Handle the Image "updated" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function updated(Image $image)
    {
    }

    /**
     * Handle the Image "deleted" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function deleted(Image $image)
    {
        //
        try {
            $paths = explode("/", $image->image_path);
            $path = $paths[1] . "/" . $paths[2] . "/" . $paths[3] . "/" . $paths[4] . "/" . "original" . "/" . $paths[6];
            if ($image->is_public) {
                File::delete(public_path($path));
            } else {
                File::delete(storage_path($path));
            }

            foreach (config('_images_cut_sizes.sizes') as $size) {
                $path = $paths[1] . "/" . $paths[2] . "/" . $paths[3] . "/" . $paths[4] . "/" . $size . "/" . $paths[6];
                File::delete(storage_path($path));
            }

            foreach (config('_images_cut_sizes.scales') as $scale) {
                $path = $paths[1] . "/" . $paths[2] . "/" . $paths[3] . "/" . $paths[4] . "/scale_" . $scale . "/" . $paths[6];
                if ($image->is_public) {
                    File::delete(public_path($path));
                } else {
                    File::delete(storage_path($path));
                }
            }
        } catch (\Exception $exception) {
            Log::error($exception);
        }
    }

    /**
     * Handle the Image "restored" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function restored(Image $image)
    {
        //
    }

    /**
     * Handle the Image "force deleted" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function forceDeleted(Image $image)
    {
        //
    }
}
