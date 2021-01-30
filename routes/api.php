<?php

use App\DeliveryDocuments;
use App\Http\Controllers\DeliveryDocumentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', 'GeneralController@searchUser');

Route::group([
    'middleware' => 'jwt.auth',
], function () {
    Route::post('logout', 'GeneralController@logoutUser');
    Route::post('profiles', 'GeneralController@registerUserProfiles');
    Route::post('years', 'GeneralController@registerUserYears');

    // *** - rutas para crear, editar, mostrar, buscar a las personas - ***
    // *** - Buscar - ***
    Route::post('persons', 'GeneralController@getPersonsByDescription');
    // *** - Aniadir - ***
    Route::get('person/add', 'GeneralController@addPerson');
    // *** - Almacenar - ***
    Route::post('person', 'GeneralController@storePerson');
    Route::get('person/{id}', 'GeneralController@getPersonById');


    // *** - rutas para crear, editar, mostrar, buscar a los usuarios del sistema - ***
    Route::post('users', 'GeneralController@getUsersByDescription');
    Route::post('user', 'GeneralController@storeUser');
    Route::get('user/{id}', 'GeneralController@getUserById');

    /*
    Route::post('upload', 'FileController@uploadFile');
    */

    Route::get('inventory/{gestion}', 'InventoryController@getOffices');
    Route::get('inventory/show/{cod_soa}', 'InventoryController@getOfficeByCodSoa');
    Route::get('inventory/sub_offices/{cod_soa}', 'InventoryController@getSubOfficesByCodSoa');
    Route::get('inventory/activos/{cod_soa}', 'InventoryController@getActivosByCodSoaAndSubOffice');
    Route::get('descargando/{cod_soa}', 'InventoryController@getReport');
    //rutas de inventarios 2 
    Route::get('inventory2/unidad', 'InventoryController@getUnidad');
    Route::get('inventory2/sub_unidad', 'InventoryController@getSubUnidad');
    Route::get('inventory2/cargos', 'InventoryController@getCargos');
    Route::get('inventory2/responsables', 'InventoryController@getResponsables');
    Route::get('inventory2/encargados', 'InventoryController@getEncargados');
    Route::post('inventory2/save', 'InventoryController@saveNewInventory');
    Route::get('inventory2/{gestion}', 'InventoryController@getInventories');
    Route::get('inventory2/edit/{id}','InventoryController@getInventory');
    //***rutas de re asignacion de activos***
    Route::get('reasignacion/', 'InventoryController@SearchActivo'); 
    Route::get('reasignacion/edit/{id}','InventoryController@getActive');


    // *** - Tesoreria - Rutas para la venta de alumnos nuevos - ***
    // *** - Buscar por su carnet de identidad - ***
    Route::post('newstudent', 'TreasureController@getNewStudentByDNI');
    // *** - Buscar los valores pertenecientes a un tramite - ***
    Route::post('valuesprocedure', 'TreasureController@getValuesProcedure');
    
});
