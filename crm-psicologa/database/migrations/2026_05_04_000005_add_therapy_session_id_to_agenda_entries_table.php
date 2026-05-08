<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agenda_entries', function (Blueprint $table): void {
            $table->foreignId('therapy_session_id')
                ->nullable()
                ->unique()
                ->after('id')
                ->constrained('therapy_sessions')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('agenda_entries', function (Blueprint $table): void {
            $table->dropConstrainedForeignId('therapy_session_id');
        });
    }
};
