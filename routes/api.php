<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/test/{name?}', function ($name=null) {
    return 'welcome '.$name ;
});
//validate the name as null or with value and contain only string
//or go to [App/Providers/RouteServiceProvider] and in the function boot Route::pattern('name','[a-zA-Z]+');
Route::match(['get','post'],'/checkReq',function (Request $request){
   return 'It is '.$request->method();
});
Route::apiResource('api',(\App\Http\Controllers\Front\ApiController::class));
//check the Request method GET or Post
