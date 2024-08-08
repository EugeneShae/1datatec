<?php

namespace Tests\Feature;

use App\Jobs\ProcessSubmission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class SubmissionTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected string $successMessage = 'Submission received and queued for processing';

    public function test_process_submission_job_is_dispatched(): void
    {
        $data = [
            'name'    => $this->faker->name,
            'email'   => $this->faker->email,
            'message' => $this->faker->sentence,
        ];

        Bus::fake();

        $this->postJson('/api/submit', $data);

        Bus::assertDispatched(ProcessSubmission::class, static function (ProcessSubmission $job) use ($data) {
            return $job->name === $data['name']
                && $job->email === $data['email']
                && $job->message === $data['message'];
        });
    }

    public function test_submission_is_stored_in_db(): void
    {
        $data = [
            'name'    => $this->faker->name,
            'email'   => $this->faker->email,
            'message' => $this->faker->sentence,
        ];

        $response = $this->postJson('/api/submit', $data);

        $response->assertStatus(202)
                 ->assertJson(['message' => $this->successMessage]);

        $this->assertDatabaseHas('submissions', $data);
    }
}
