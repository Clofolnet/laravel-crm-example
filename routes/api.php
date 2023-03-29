<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
return $request->user();
}); */


Route::group(
    [
        'prefix' => 'v1',
        // 'middleware' => ['auth:api']
    ],
    function () {

        Route::apiResource('/comments', CommentController::class)->only([
            'index',
            'show',
            'store',
            'update',
            'destroy'
        ]);
        Route::apiResource('/majors', MajorController::class)->only([
            'index',
            'show',
            'store',
            'update',
            'destroy'
        ]);
        Route::apiResource('/regions', RegionController::class)->only([
            'index',
            'show',
            'store',
            'update',
            'destroy'
        ]);
        Route::apiResource('/students', StudentController::class)->only([
            'index',
            'show',
            'store',
            'update',
            'destroy'
        ]);
        Route::apiResource('/users', UserController::class)->only([
            'index',
            'show',
            'store',
            'update',
            'destroy'
        ]);
    }
);