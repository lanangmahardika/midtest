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

Route::get('/', function () {
    return view('home');
});

//Login dan logout
Route::get('/login','AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin');
Route::get('/logout','AuthController@logout');

//Hak Akses Admin
Route::group(['middleware' => ['auth','checkRole:admin,guru']], function(){ 

    //Siswa
    Route::get('/siswa','SiswaController@index');
    Route::get('/siswa/{id}/profile','SiswaController@profile');
    Route::post('/siswa/create','SiswaController@create');
    Route::get('/siswa/{id}/edit','SiswaController@edit');
    Route::post('/siswa/{id}/update','SiswaController@update');
    Route::get('/siswa/{id}/delete','SiswaController@delete');
    Route::post('/siswa/{id}/tambahnilai','SiswaController@tambahnilai');
    Route::get('/siswa/{id}/{idmapel}/delete','SiswaController@deletenilai');

    //Mapel
    Route::get('/mapel','MapelController@index');
    Route::post('/mapel/create','MapelController@create');
    Route::get('/mapel/{mapel}/edit','MapelController@edit');
    Route::post('/mapel/{id}/update','MapelController@update');
    Route::get('/mapel/{id}/delete','MapelController@delete');
});

Route::group(['middleware' => ['auth','checkRole:admin,siswa']], function(){
    Route::get('/dashboard','DashboardController@index');
});
    