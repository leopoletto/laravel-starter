<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'unsubscribed',
        'audience_id',
        'resend_id',
        'verify_token',
        'verified_at',
        'unsubscribed_at',
    ];

    protected function casts(): array
    {
        return [
            'unsubscribed' => 'boolean',
            'audience_id' => 'string',
            'resend_id' => 'string',
            'verified_at' => 'datetime',
            'unsubscribed_at' => 'datetime',
        ];
    }
}
