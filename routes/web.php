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

// Funcionários
Route::get('/work', 'WorkController@lista');
Route::get('/work/mostra/{id}', 'WorkController@mostra')->where('id', '[0-9]+');
Route::get('/work/remove/{id}', 'WorkController@remove')->where('id', '[0-9]+');
Route::get('/work/novo', 'WorkController@novo');
Route::post('/work/adiciona', 'WorkController@adiciona');
Route::post('/work/mostra/adicionaRecord', 'WorkController@adicionaRecord');
Route::get('/work/edita/{id}', 'WorkController@edita')->where('id', '[0-9]+');
Route::post('/work/edita/atualiza', 'WorkController@atualiza');

// Users
Route::get('/user', 'UserController@lista');
Route::get('/user/mostra/{id}', 'UserController@mostra')->where('id', '[0-9]+');
Route::get('/user/remove/{id}', 'UserController@remove')->where('id', '[0-9]+');
Route::post('/user/adiciona', 'UserController@adiciona');
Route::get('/user/edita/{id}', 'UserController@edita')->where('id', '[0-9]+');
Route::post('/user/edita/atualiza', 'UserController@atualiza');

// Registros
Route::get('/record', 'RecordController@lista');
Route::get('/', 'RecordController@lista');
Route::get('/record/remove/{id}', 'RecordController@remove')->where('id', '[0-9]+');
Route::get('/record/edita/{id}', 'RecordController@edita')->where('id', '[0-9]+');
Route::post('/record/edita/atualiza', 'RecordController@atualiza');
Route::get('/record/novo', 'RecordController@novo');
Route::post('/record/adiciona', 'RecordController@adiciona');

// Departamentos
Route::get('/department', 'DepartmentController@lista');
Route::get('/department/mostra/{id}', 'DepartmentController@mostra')->where('id', '[0-9]+');
Route::get('/department/remove/{id}', 'DepartmentController@remove')->where('id', '[0-9]+');
Route::get('/department/novo', 'DepartmentController@novo');
Route::post('/department/adiciona', 'DepartmentController@adiciona');

Auth::routes();

// Emails
Route::get('work/emailMore/{id}', 'WorkController@emailMore')->where('id', '[0-9]+');