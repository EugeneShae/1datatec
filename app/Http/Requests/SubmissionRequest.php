<?php

namespace App\Http\Requests;

use App\Http\Contracts\SubmissionRequestInterface;
use Illuminate\Foundation\Http\FormRequest;

final class SubmissionRequest extends FormRequest implements SubmissionRequestInterface
{
    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email'],
            'message' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Name is required',
            'name.string'      => 'Name must be a string',
            'name.max'         => 'Name must not exceed 255 characters',
            'email.required'   => 'Email is required',
            'email.email'      => 'Email must be a valid email address',
            'message.required' => 'Message is required',
            'message.string'   => 'Message must be a string',
        ];
    }

    public function getName(): string
    {
        return $this->validated('name');
    }

    public function getEmail(): string
    {
        return $this->validated('email');
    }

    public function getMessage(): string
    {
        return $this->validated('message');
    }
}
