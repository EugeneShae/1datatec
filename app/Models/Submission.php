<?php

namespace App\Models;

use App\Events\SubmissionSaved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $email
 * @property string $message
 */
class Submission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'message'];

    protected $dispatchesEvents = [
        'created' => SubmissionSaved::class,
    ];
}
