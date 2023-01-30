<?php

use App\Http\Controllers\{BlockController, CalendarController, ScheduleController, UnityController, UserController};
use Illuminate\Support\Facades\Route;


/* Reservation related routes */

Route::get('/reservations', [ScheduleController::class, 'index'])->name('reservation.index');
Route::delete('/reservation/{code}', [ScheduleController::class, 'destroy'])->name('reservation.destroy');
Route::put('/reservation/{code}', [ScheduleController::class, 'update'])->name('reservation.update');
Route::get('/reservation/{code}/edit', [ScheduleController::class, 'edit'])->name('reservation.edit');
Route::get('/reservation/create', [ScheduleController::class, 'create'])->name('reservation.create');
Route::post('/reservation', [ScheduleController::class, 'store'])->name('reservation.store');

/* Room related routes */

Route::get('/rooms', [ScheduleController::class, 'index'])->name('room.index');
Route::delete('/room/{code}', [ScheduleController::class, 'destroy'])->name('room.destroy');
Route::put('/room/{code}', [ScheduleController::class, 'update'])->name('room.update');
Route::get('/room/{code}/edit', [ScheduleController::class, 'edit'])->name('room.edit');
Route::get('/room/create', [ScheduleController::class, 'create'])->name('room.create');
Route::post('/room', [ScheduleController::class, 'store'])->name('room.store');

/* Schedule related routes */

Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedule.index');
Route::delete('/schedule/{code}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
Route::put('/schedule/{code}', [ScheduleController::class, 'update'])->name('schedule.update');
Route::get('/schedule/{code}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
Route::get('/schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');
Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');

/* Calendar related routes */

Route::get('/calendars', [CalendarController::class, 'index'])->name('calendar.index');
Route::delete('/calendar/{year}/{period}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
Route::put('/calendar/{year}/{period}', [CalendarController::class, 'update'])->name('calendar.update');
Route::get('/calendar/{year}/{period}/edit', [CalendarController::class, 'edit'])->name('calendar.edit');
Route::get('/calendar/create', [CalendarController::class, 'create'])->name('calendar.create');
Route::post('/calendar', [CalendarController::class, 'store'])->name('calendar.store');

/* Block related routes */

Route::get('/blocks', [BlockController::class, 'index'])->name('block.index');
Route::delete('/block/{code}', [BlockController::class, 'destroy'])->name('block.destroy');
Route::put('/block/{code}', [BlockController::class, 'update'])->name('block.update');
Route::get('/block/{code}/edit', [BlockController::class, 'edit'])->name('block.edit');
Route::get('/block/create', [BlockController::class, 'create'])->name('block.create');
Route::post('/block', [BlockController::class, 'store'])->name('block.store');

/* Unity related routes */

Route::get('/unities', [UnityController::class, 'index'])->name('unity.index');
Route::delete('/unity/{code}', [UnityController::class, 'destroy'])->name('unity.destroy');
Route::put('/unity/{code}', [UnityController::class, 'update'])->name('unity.update');
Route::get('/unity/{code}/edit', [UnityController::class, 'edit'])->name('unity.edit');
Route::get('/unity/create', [UnityController::class, 'create'])->name('unity.create');
Route::post('/unity', [UnityController::class, 'store'])->name('unity.store');

/* User related routes */
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::delete('/user/{email}', [UserController::class, 'destroy'])->name('user.destroy');
Route::put('/user/{email}', [UserController::class, 'update'])->name('user.update');
Route::get('/user/{email}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');

Route::get('/', function () {
    return view('login');
});
