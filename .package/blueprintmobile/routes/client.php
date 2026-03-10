<?php

use Illuminate\Support\Facades\Route;
use Pterodactyl\BlueprintFramework\Extensions\blueprintmobile\BlueprintMobileClientController;

Route::get('/', [BlueprintMobileClientController::class, 'index']);
Route::get('/extensions/{identifier}', [BlueprintMobileClientController::class, 'show']);
