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
    return view('welcome');    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('registers','RegisterController');

Route::resource('calibration','CalibrationController');
Route::get('print/{id}','CalibrationController@report')->name('calibration.print');

Route::resource('models_eqp','ModelOfEquipamentController');

Route::get('report/default/{id}','ReportsController@default_report')->name('report.default');
Route::get('report/159/{id}','ReportsController@report159')->name('report.159');
Route::get('report/160/{id}','ReportsController@report159')->name('report.160');
Route::get('report/161/{id}','ReportsController@report161')->name('report.161');
Route::get('report/163/{id}','ReportsController@report163')->name('report.163');
Route::get('report/164/{id}','ReportsController@report164')->name('report.164');
Route::get('report/165/{id}','ReportsController@report165')->name('report.165');
Route::get('report/170/{id}','ReportsController@report170')->name('report.170');
Route::get('report/175/{id}','ReportsController@report175')->name('report.175');
Route::get('report/205/{id}','ReportsController@report205')->name('report.205');
Route::get('report/207/{id}','ReportsController@report207')->name('report.207');
Route::get('report/213/{id}','ReportsController@report213')->name('report.213');
Route::get('report/324/{id}','ReportsController@report324')->name('report.324');
Route::post('report','ReportsController@pdf324')->name('report.324.pdf');