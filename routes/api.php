<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactDetailController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('services', ServiceController::class);
Route::apiResource('contact-details', ContactDetailController::class)->middlewareFor('store', 'throttle:contact-form');
Route::post('/autoseo/webhook', [WebhookController::class, 'handle']);
Route::prefix('blogs')->group(function () {

    // Get all published blogs
    Route::get('/', [BlogController::class, 'index']);

    // Get a single blog by slug
    Route::get('/{slug}', [BlogController::class, 'show']);
});