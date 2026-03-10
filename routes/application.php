<?php

use Illuminate\Support\Facades\Route;
use Pterodactyl\BlueprintFramework\Extensions\blueprintmobile\BlueprintMobileApplicationController;

Route::get('/', [BlueprintMobileApplicationController::class, 'index']);
Route::get('/extensions/{identifier}', [BlueprintMobileApplicationController::class, 'show']);
