<?php

use App\Http\Controllers\Api\EventsController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\TicketPurchaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('event', EventsController::class);
// Route::apiResource('tickets', TicketController::class)->except(["index"]);

// Route::get('github/{owner}/{repo}', [GitHubController::class, "show"]);
// Route::get('github/{owner}/{repo}/languages', [GitHubController::class, "getLanguages"]);

// Route::get('ticket/{event}', [TicketController::class, "index"]);

Route::post('/tickets/purchase', [TicketPurchaseController::class, 'store']);
