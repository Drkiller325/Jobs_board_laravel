<?php

namespace App\Jobs;

use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TranslateJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Job $joblisting)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //AI::translate($this->joblisting->description, 'spanish'); an example on how to use the queue for tasks that take time\
        logger('Translating ' . $this->joblisting->title . ' to Spanish');
    }
}
