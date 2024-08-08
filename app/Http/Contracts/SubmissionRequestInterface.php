<?php

namespace App\Http\Contracts;

interface SubmissionRequestInterface
{
    public function getName(): string;

    public function getEmail(): string;

    public function getMessage(): string;
}
