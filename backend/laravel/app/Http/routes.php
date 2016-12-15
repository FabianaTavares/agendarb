<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


use Swagger\Annotations as SWG;

/* vendor/bin/swagger app -o public/swagger.json */

/**
 * @SWG\Swagger(
 *          schemes={"http"},
 *          basePath="/Public/agendarb/backend/laravel/public/",
 *          produces={"application/json"},
 * 	        consumes={"application/json"},
 *          @SWG\Info(
 *              version="1.0.0",
 *              title="Sistema de Agenda de Contatos API",
 *              description="Sistema de Agenda de Contatos - RB",
 *              @SWG\Contact(email="contato@frtavares.com.br"),
 *              @SWG\License( name="", url="")
 *          ),

 * )
 */
Route::get('/', function () {
    return view('welcome');
});

Route::get('/operadoras', 'OperadoraController@index');          //retornar lista que já existe
Route::post('/operadoras', 'OperadoraController@store');        //inserir no banco
Route::get('/operadoras/{id}', 'OperadoraController@find');      //retornar uma operadora passando o id
Route::put('/operadoras/{id}', [  //editar uma operadora
    'as'        => 'operadoras.put',
    'uses'      => 'OperadoraController@update',
]);
Route::delete('/operadoras/{id}', 'OperadoraController@delete'); //exclui uma operadora do banco de dados
Route::resource('/operadoras','OperadoraController');