<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
use App\Http\Controllers\LeaderboardController;

Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/rallies/{rally}/stages', [EventController::class, 'getStages']); // AJAX
Route::post('/events', [EventController::class, 'store']);
Route::post('/stage-times/single', [EventController::class, 'saveSingleStageTime']);
Route::post('/events/{event}/stage-times', [EventController::class, 'saveStageTime']);

Route::get('/events/{event}', [EventController::class, 'show']);
Route::patch('/events/{event}/end', [EventController::class, 'end']);

Route::get('/leaderboard', [LeaderboardController::class, 'index'])
    ->name('leaderboard.index');
Route::get('/leaderboard/stage/{stage}', [LeaderboardController::class, 'stage'])
    ->name('leaderboard.stage');

Route::get('/locations', [EventController::class, 'locations'])->name('locations');

