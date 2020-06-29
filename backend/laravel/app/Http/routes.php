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

/*
 * vendor/bin/swagger app -o public/swagger.json
 * composer dump-autoload
 * Acessar o Swagger para Testes de API
 * Colocar na url do navegador o caminho correspondente ao projeto a index do swagger Ex: http://localhost:8000/docs/index.html
 * Em seguida na url do swagger colocar o caminho do swagger.json: http://localhost:8000/swagger.json
 * Se for realizar testes pelo swagger após entrar com o usuario e senha será gerado um token.
 * Ao ir no botão "Authorize" e inserir o token no campo value é necessário escrever a palavra Bearer na frente.
 * Ex: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE1NTU4NzE3MjQsImV4cCI6MTU1NTg3NTMyNCwibmJmIjoxNTU1ODcxNzI0LCJqdGkiOiJxcnlGMHcxSVpSbnkydjNwIiwic3ViIjoxLCJwcnYiOiIyYTczMDhmNDUwNzQ2NmQwYmEwZGVkYTkwYjg2MWY4NzMwYzQ4MTYwIn0.R-eqmkRxo9JDUrwTxCOwhjsHXgI7azT06HQAR1MD5-I

*/

/**
 * @SWG\Swagger(
 *          schemes={"http"},
 *          basePath="http://localhost:8000/swagger.json",
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