<?php

use Illuminate\Support\Facades\Route;

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
Route::get('persona','GeneralController@getPersonByCI');
Route::post('newPerson','GeneralController@saveNewPerson');
Route::get('person/{id}', 'GeneralController@getPersonById');
Route::get('description/{abr}', 'DocumentController@getDescriptionByAbr');

Route::get('/{any}', 'HomeController@index')->where('any', '.*');

//  * Ruta añadida para redireccionar a la misma pagina.    

Route::get('files', 'FileController@index');
Route::post('upload', 'FileController@uploadFile');
Route::get('delete/upload-folder/{file}', 'FileController@deleteFile');
Route::get('download/upload-folder/{file}', 'FileController@downloadFile');
Route::get('reportSelectedFixedAssets2/', 'FixedAssetController@getReportSelectedFixedAssets2');

/*
Route::get('/', function () {
    return view('welcome');
});*/


