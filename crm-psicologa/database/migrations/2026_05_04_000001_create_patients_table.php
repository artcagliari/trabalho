<?php
use Illuminate\Database\Migrations\Migration;use Illuminate\Database\Schema\Blueprint;use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::create('patients', function (Blueprint $table) { $table->id();$table->string('full_name');$table->string('phone',20);$table->string('email')->unique();$table->date('birth_date');$table->text('main_complaint');$table->enum('care_status',['ativo','em pausa','encerrado']);$table->timestamps(); }); } public function down(): void { Schema::dropIfExists('patients'); } };
