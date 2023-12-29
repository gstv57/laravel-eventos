<?php

use App\Http\Controllers\{EventController, UserController};

use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'index']);
Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');
Route::get('/events/{id}', [EventController::class, 'show']);
Route::post('/events', [EventController::class, 'store']);
Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth');
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth');
Route::put('/events/update/{id}', [EventController::class, 'update'])->middleware('auth');
Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');
Route::post('/events/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');
Route::delete('/events/leave/{id}', [EventController::class, 'leaveEvent'])->middleware('auth');
Route::get('/events/finish/{id}', [EventController::class, 'finishEvent'])->middleware('auth');
Route::get('/events/participated', [EventController::class, 'participated'])->middleware('auth');

Route::get('/profile', [UserController::class, 'index'])->middleware('auth');
Route::get('/profile/edit', [UserController::class, 'edit'])->middleware('auth');
Route::put('/profile/edit/{id}', [UserController::class, 'update'])->middleware('auth');
Route::get('/profile/create', [UserController::class, 'create'])->middleware('auth');
Route::post('/profile/save', [UserController::class, 'store'])->middleware('auth');
Route::get('/profile/bank/create', [UserController::class, 'accountBankGet'])->middleware('auth');
Route::post('/profile/bank/save', [UserController::class, 'accountBankRegister'])->middleware('auth');
