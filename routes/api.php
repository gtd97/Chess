<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/holi', function () {
  return "Hola";
});

// Funcion que se encarga de comprovar si el usuario 
Route::get('/login/{usuario}/{password}', function ($usuario, $password) {
    
    if( Auth::attempt(['name' => $usuario, 'password' => $password])){
		// si es true entra aqui, con lo cual el usuario existe.
    	return "El siguiente usuario, es correcto:      name: ".$usuario." password: ".$password;
	}
	else{
		return "El siguiente usuario, no existe:      name: ".$usuario." password: ".$password;
	}
});


Route::get('/auth/{name}', function ($name) {
	$users = User::where('name', $name )->select('api_token')->get();

	// No tiene ningun token actualmente
	if( $users[0]['api_token'] == 0){
		$rand_part = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789".uniqid());

		User::where('name', $name )->update(['api_token' => $rand_part]);
		
		return "Tu nuevo Token es... : ". $rand_part;
	}
	else{
		return $users[0]['api_token'];
	}
	
});