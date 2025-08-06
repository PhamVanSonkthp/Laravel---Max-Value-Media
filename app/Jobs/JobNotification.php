<?php

namespace App\Jobs;

use App\Models\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class JobNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $title;
    private $description;
    private $topic;
    private $userID;
    private $isSave;
    private $imagePath;
    private $activity;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($topic, $title, $description, $is_save = false, $user_id = null, $image_path = null, $activity = null)
    {
        //
        $this->topic = $topic;
        $this->title = $title;
        $this->description = $description;
        $this->isSave = $is_save;
        $this->userID = $user_id;
        $this->imagePath = $image_path;
        $this->activity = $activity;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Helper::sendNotificationToTopic(
            $this->topic,
            $this->title,
            $this->description,
            $this->isSave,
            $this->userID,
            $this->imagePath,
            $this->activity
        );
    }
}
