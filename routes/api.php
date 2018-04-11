<?php

use Illuminate\Http\Request;
use App\Partida;

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


// Funcion que se encarga de comprovar si el usuario es correcto. 
Route::get('/login/{usuario}/{password}', function ($usuario, $password) {
    if( Auth::attempt(['name' => $usuario, 'password' => $password])){
		// si es true entra aqui, con lo cual el usuario existe.
    	return "El siguiente usuario, es correcto:      name: ".$usuario." password: ".$password;
	}
	else{
		return "El siguiente usuario, no existe:      name: ".$usuario." password: ".$password;
	}
});


// Obtener Token y sino tiene lo asigna.
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


// Mover ficha.
Route::get('/mou/{usuario}/{partida}/{fila_ini}/{col_ini}/{fila_dest}/{col_dest}', function ($usuario, $partida, $fila_ini, $col_ini, $fila_dest, $col_dest ) {


	return "Estas moviendo la ficha: \n\t- usuario: ".$usuario."\n\t- partida: ".$partida."\n\t- fila_inicio: ".$fila_ini."\n\t- col_inicio: ".$col_ini."\n\t- fila_destino: ".$fila_dest."\n\t- col_destino: ". $col_dest."\n";
});


// Crear partida.
Route::get('/crear_partida/{id_jugador1}/{id_jugador2}', function ($id_jugador1, $id_jugador2) {
	$partida = new Partida();
	//$partida->id_partida = 1;
	$partida->estado = $id_jugador1;
	$partida->jugador_1 = $id_jugador1;
	$partida->jugador_2 = $id_jugador2;
	$partida->save();
});


// Listado usuarios esperando a buscar partida.
Route::get('/en_espera', function () {
});


// Obtener id_partida
Route::get('/id_partida', function () {

});

