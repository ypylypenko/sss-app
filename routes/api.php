<?php

use App\Http\Controllers\Api\ClosedTicketController;
use App\Http\Controllers\Api\OpenTicketController;
use Illuminate\Support\Facades\Route;

Route::middleware([])->group(function () {
    Route::prefix('tickets')->group(function () {
        Route::get('open', OpenTicketController::class);
        Route::get('closed', ClosedTicketController::class);
    });
});
