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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



/* Administradores */
Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Admin\Auth\LoginController@login');
  Route::post('/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

  Route::get('/register', 'Admin\Auth\RegisterController@showRegistrationForm')->name('admin.register');
  Route::post('/register', 'Admin\Auth\RegisterController@register');

  Route::post('/password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.request');
  Route::post('/password/reset', 'Admin\Auth\ResetPasswordController@reset')->name('admin.password.email');
  Route::get('/password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.reset');
  Route::get('/password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm');
});

Route::group(['prefix' => 'admin',  'middleware' => 'admin'], function(){
  Route::get('/', 'Admin\HomeController@index')->name('admin.home');

  /* Clientes */
  Route::resource('clientes', 'Admin\ClienteController')->names('admin.clientes');
  

  /* Clientes */
  Route::resource('coordinadores', 'Admin\CoordinadorController')->names('admin.coordinadores')->parameters(['coordinadores' => 'id']);

  /* Asesores */
  Route::resource('asesores', 'Admin\AsesorController')->names('admin.asesores')->parameters(['asesores' => 'asesor']);

  /* Boletas */
  Route::resource('boletas', 'Admin\BoletaController')->names('admin.boletas');
  Route::post('agregar/curso/{boleta}', 'Admin\BoletaController@agregarCursos')->name('agregar.cursos');
  Route::delete('borrar/curso/{curso}', 'Admin\BoletaController@borrarCursos')->name('borrar.cursos');
  Route::get('generar/pdf/{boleta}', 'Admin\BoletaController@generarPDF')->name('generar.pdf');


  /* Paquetes */
  Route::resource('paquetes', 'Admin\PaqueteController')->names('admin.paquetes')->parameters(['paquetes' => 'id']);
  Route::post('asignar/paquete', 'Admin\PaqueteController@asignarPaquete')->name('admin.asignar.paquete');


  /* Asesorias */
  Route::resource('asesorias', 'Admin\AsesoriaController')->names('admin.asesorias');
  /* Route::get('nueva/asesoria', 'Admin\AsesoriaController@nuevaAsesoria')->name('admin.asesorias.nuevaAsesoria');
  Route::post('nueva/asesoria', 'Admin\AsesoriaController@storeAsesoria')->name('admin.asesorias.storeAsesoria');
  Route::delete('eliminar/asesoria/{asesoria}', 'Admin\AsesoriaController@eliminarAsesoria')->name('admin.eliminar.asesoria'); */
});




/* Asesores */
Route::group(['prefix' => 'asesor'], function () {
  Route::get('/login', 'Asesor\Auth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'Asesor\Auth\LoginController@login');
  Route::post('/logout', 'Asesor\Auth\LoginController@logout')->name('logout');

  Route::get('/register', 'Asesor\Auth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'Asesor\Auth\RegisterController@register');

  Route::post('/password/email', 'Asesor\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'Asesor\Auth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'Asesor\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'Asesor\Auth\ResetPasswordController@showResetForm');
});
