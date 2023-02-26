<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get("/construct/excel/detail/download/{construct_id}", "ConstructorController@detail_excel_download")->name("constructs.excel.detail.download");
Route::get("/construct/excel/index/download/{page}", "ConstructorController@excel_download")->name("constructs.excel.index.download");

Route::get("/construct", "ConstructorController@index")->name("construct");
Route::get("/construct/create", "ConstructorController@create")->name("construct.create");
Route::post("/construct/store", "ConstructorController@store")->name("construct.store");
Route::get("/construct/edit/{id}", "ConstructorController@edit")->name("construct.edit");
Route::post("/construct/update", "ConstructorController@update")->name("construct.update");
Route::post("/construct/delete", "ConstructorController@delete")->name("construct.delete");

Route::get("/checklist", "CheckListController@index")->name('checklist');
Route::get("/checklist/create", "CheckListController@create")->name("checklist.create");
Route::post("/checklist/store", "CheckListController@store")->name("checklist.store");
Route::get("/checklist/edit/{id}", "CheckListController@edit")->name("checklist.edit");
Route::post("/checklist/update", "CheckListController@update")->name("checklist.update");
Route::post("/checklist/delete", "CheckListController@delete")->name("checklist.delete");
Route::get("/pdf/{checklist_id}", "CheckListController@pdf")->name("pdf");


Route::get("/calendar", "CalendarController@index")->name( 'calendar');

Route::get("/api", "ConstructorController@api")->name('api');
Route::get("/remind", "ConstructorController@remind")->name('remind');

Auth::routes();
