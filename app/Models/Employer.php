<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employer extends Model
{
    use HasFactory;

        // method to get all jobs created by employer
    public function jobs() {
        return $this->hasMany(Job::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    
}
