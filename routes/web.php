<?php

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


Route::get('/', 'HomePageController@index');

Route::get('/login', 'LoginController@exibir_login');
Route::get('/cadastro', 'CadastroController@exibir_cadastro');


Route::get('/series', 'SeriesController@exibir_series');
Route::get('/series/adicionar', 'SeriesController@exibir_adicionar_serie');
Route::post('/series/adicionar', 'SeriesController@add_serie');
Route::post('/series/remover/{id}', 'SeriesController@del_serie');


Route::get('/series/{serie_id}/temporadas', 'TemporadasController@exibir_temporadas');


Route::get('/series/temporadas/{temporada_id}/episodios', 'EpisodiosController@exibir_episodios');

