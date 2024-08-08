<?php

namespace App\Jobs;

use App\Http\Contracts\SubmissionRequestInterface;
use App\Models\Submission;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class ProcessSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $name;
    public string $email;
    public string $message;

    /**
     * Create a new job instance.
     */
    public function __construct(SubmissionRequestInterface $request)
    {
        $this->name = $request->getName();
        $this->email = $request->getEmail();
        $this->message = $request->getMessage();
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle(): void
    {
        try {
            $submission = new Submission();
            $submission->name = $this->name;
            $submission->email = $this->email;
            $submission->message = $this->message;
            $submission->save();
        } catch (Exception $e) {
            logger()?->error('Submission saving failed', [
                'error'   => $e->getMessage(),
                'name'    => $this->name,
                'email'   => Str::of($this->email)->mask('*', 4, -4),
                'message' => $this->message,
            ]);

            throw $e;
        }
    }
}
