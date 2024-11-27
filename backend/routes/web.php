<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/jobs/create', 'JobController@create')->middleware('role:Recrutador');
    Route::post('/jobs', 'JobController@store')->middleware('role:Recrutador');

      // Rotas para visualizar, editar e deletar vagas
      Route::get('/jobs/my-jobs', 'JobController@index')->middleware('role:Recrutador')->name('jobs.index');
      Route::get('/jobs/{id}/edit', 'JobController@edit')->middleware('role:Recrutador')->name('jobs.edit');
      Route::post('/jobs/{id}', 'JobController@update')->middleware('role:Recrutador')->name('jobs.update');
      Route::delete('/jobs/{id}', 'JobController@destroy')->middleware('role:Recrutador')->name('jobs.destroy');

    Route::get('/jobs', 'JobController@index')->middleware('role:Candidato');
    Route::post('/applications', 'ApplicationController@store')->middleware('role:Candidato');
});
