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
/*
Route::get('/shot', function (){
    return ['message'=>'*** You miss ***'];
});
 * 
 */
Route::group(['middleware' => 'api'], function () {
    Route::post('/shot' , 'BattleshipApi@shot')->name('front.shot');
    Route::get('/newgame' , 'BattleshipApi@newgame')->name('front.newgame');
    
});

//Route::post('/shot', 'BattleshipApi@shot');
//Route::get('/newgame', 'BattleshipApi@newgame');

/*
Route::group(['middleware' => ['web']], function () {
    Route::post('/shot', 'BattleshipApi@shot');
    Route::get('/newgame', 'BattleshipApi@newgame');
});
 * 
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
