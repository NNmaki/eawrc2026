<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index']);
Route::get('/rallies/{rally}/stages', [EventController::class, 'getStages']); // AJAX
Route::post('/events', [EventController::class, 'store']);
Route::post('/events/{event}/stage-times', [EventController::class, 'saveStageTime']);

