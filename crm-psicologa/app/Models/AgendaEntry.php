<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgendaEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'therapy_session_id',
        'patient_id',
        'consultation_date',
        'consultation_time',
        'title',
        'notes',
    ];

    protected $casts = [
        'consultation_date' => 'date',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function therapySession(): BelongsTo
    {
        return $this->belongsTo(TherapySession::class);
    }
}
