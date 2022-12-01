<?php

use Illuminate\Support\Facades\Auth;
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

Route::get("/construct", "ConstructorController@index")->name("construct");
Route::get("/construct/create", "ConstructorController@create")->name("construct.create");
Route::post("/construct/store", "ConstructorController@store")->name("construct.store");
Route::get("/construct/edit/{id}", "ConstructorController@edit")->name("construct.edit");
Route::post("/construct/update", "ConstructorController@update")->name("construct.update");
Route::post("/construct/delete", "ConstructorController@delete")->name("construct.delete");

Route::get("/checklist", "ChecklistController@index")->name('checklist');
Route::get("/checklist/create", "ChecklistController@create")->name("checklist.create");
Route::post("/checklist/store", "ChecklistController@store")->name("checklist.store");
Route::get("/checklist/edit/{id}", "ChecklistController@edit")->name("checklist.edit");
Route::post("/checklist/update", "ChecklistController@update")->name("checklist.update");
Route::post("/checklist/delete", "ChecklistController@delete")->name("checklist.delete");

Route::get("/calendar", "CalendarController@index")->name( 'calendar');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
