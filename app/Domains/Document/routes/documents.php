<?php

use App\Domains\Document\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

Route::get('/{document}', [DocumentController::class, 'get']);
Route::apiResource('', DocumentController::class)->only('store', 'destroy');
