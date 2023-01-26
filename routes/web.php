<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoUploaderController;
 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[VideoUploaderController::class,'index']);


Route::get('/uploadvideo',[VideoUploaderController::class,'create']);

Route::post('/uploadvideo',[VideoUploaderController::class,'store'])->name('save-video');

