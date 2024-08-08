<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Jobs\ProcessSubmission;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class SubmissionController extends Controller
{
    public function submit(SubmissionRequest $request): JsonResponse
    {
        dispatch(new ProcessSubmission($request));

        return response()->json([
            'message' => 'Submission received and queued for processing'
        ], Response::HTTP_ACCEPTED);
    }
}
