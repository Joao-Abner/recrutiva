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
    Route::get('/jobs', 'JobController@index')->middleware('role:Candidato');
    Route::post('/applications', 'ApplicationController@store')->middleware('role:Candidato');
});
