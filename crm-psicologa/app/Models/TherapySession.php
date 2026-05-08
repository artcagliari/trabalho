<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TherapySession extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'session_date',
        'session_time',
        'attendance_type',
        'session_status',
        'notes',
    ];

    protected $casts = [
        'session_date' => 'date',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function agendaEntry(): HasOne
    {
        return $this->hasOne(AgendaEntry::class);
    }

    public function clinicalNotes(): HasMany
    {
        return $this->hasMany(ClinicalNote::class);
    }
}
