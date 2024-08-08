<?php

namespace App\Listeners;

use App\Events\SubmissionSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class LogSubmissionSaved implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(SubmissionSaved $event): void
    {
        $submission = $event->submission;
        $name = $submission->getName();
        $email = Str::of($submission->getEmail())->mask('*', 4, -4);

        info("New Submission created", compact([
            'name',
            'email',
        ]));
    }
}
