<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'birth_date',
        'main_complaint',
        'care_status',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function therapySessions(): HasMany
    {
        return $this->hasMany(TherapySession::class);
    }

    public function clinicalNotes(): HasMany
    {
        return $this->hasMany(ClinicalNote::class);
    }
}
