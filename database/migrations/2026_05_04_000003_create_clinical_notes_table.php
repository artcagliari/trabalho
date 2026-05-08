<?php
use Illuminate\Database\Migrations\Migration;use Illuminate\Database\Schema\Blueprint;use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::create('clinical_notes', function (Blueprint $table) { $table->id();$table->foreignId('patient_id')->constrained()->cascadeOnDelete();$table->string('title');$table->text('content');$table->date('created_on');$table->timestamps(); }); } public function down(): void { Schema::dropIfExists('clinical_notes'); } };
