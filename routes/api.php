<?php

use App\Http\Controllers\Api\V1\WikiController;

Route::group(['prefix' => 'v1'], function () {
    Route::post('wiki', [WikiController::class, 'store']);
    
});
