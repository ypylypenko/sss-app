<?php

use App\Http\Controllers\Api\ClosedTicketController;
use App\Http\Controllers\Api\OpenTicketController;
use App\Http\Controllers\Api\StatsController;
use App\Http\Controllers\Api\UserTicketController;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:60,1'])->group(function () {
    Route::get('/stats', StatsController::class);
    Route::get('/users/{email}/tickets', UserTicketController::class);

    Route::prefix('tickets')->group(function () {
        Route::get('open', OpenTicketController::class);
        Route::get('closed', ClosedTicketController::class);
    });
});
