<?php
use App\Http\Controllers\ClinicalNoteController;use App\Http\Controllers\DashboardController;use App\Http\Controllers\PatientController;use App\Http\Controllers\TherapySessionController;use Illuminate\Support\Facades\Route;
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('patients', PatientController::class);
Route::resource('therapy-sessions', TherapySessionController::class);
Route::resource('clinical-notes', ClinicalNoteController::class);
