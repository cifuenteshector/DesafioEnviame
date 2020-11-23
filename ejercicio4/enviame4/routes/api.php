<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PersonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//CRUD EMPRESAS
Route::post('/company', [CompanyController::class,'store']);
Route::post('/deletecompany', [CompanyController::class,'destroy']);
Route::get('/getcompany', [CompanyController::class,'getEmpresa']);
Route::get('/allcompany', [CompanyController::class,'show']);
Route::put('/updatecompany', [CompanyController::class,'update']);

//CRUD PERSONAS
Route::get('/allperson', [PersonController::class,'show']);
Route::get('/getperson', [PersonController::class,'getPersona']);
Route::post('/deletecompany', [PersonController::class,'destroy']);
Route::post('/person', [PersonController::class,'store']);
Route::put('/updateperson', [PersonController::class,'update']);
