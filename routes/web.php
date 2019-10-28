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
    return view('faculty.home');
})->name('index');

Auth::routes();

Route::get('/home','HomeController@index')->name('index');



Route::resource('home/allotcourse','coursealloting');
Route::resource('home/marksIA','marksIA');
Route::resource('home/marksTW','marksTW');
Route::resource('home/marksORPR','marksORPR');

Route::Post('home/marksiaverification','marksIA@marksiaverification')->name('iaverification');
Route::Post('home/markstwverification','marksTW@markstwverification')->name('twverification');
Route::Post('home/marksorprverification','marksORPR@marksorprverification')->name('orprverification');
Route::post('home/pdfIa','pdfcontroller@ia');
Route::post('home/pdftw','pdfcontroller@tw');
Route::post('home/pdforpr','pdfcontroller@orpr');


Route::Post('home/allotcourse/select_course', 'coursealloting@select_course')->name('select_course');
//Route::Post('home/allotcourse/show_course', 'coursealloting@show_course')->name('show_course');

Route::Post('home/allotcourse/fetch', 'coursealloting@fetch')->name('fetch');

Route::Post('home/allotcourse/getvalue','coursealloting@getvalue')->name('getvalue');

Route::Post('home/studentIA','coursealloting@studentIA')->name('studentIA');
Route::Post('home/studentTW','coursealloting@studentTW')->name('studentTW');
Route::Post('home/studentOR','coursealloting@studentOR')->name('studentOR'); 



Route::get('home/showsubmittedmarks','showsubmittedmarks@hod_showmarks')->name('hod_showmarks');


Route::Post('home/showsubmittedmarks/status', 'showsubmittedmarks@status')->name('detail_status');
Route::get('home/showsubmittedmarks/{course_id}', 'hodpreviewmarks@index')->name('hodpreviewmarks');
Route::get('home/previewmarks','pdfcontroller@previewmarks')->name('previewmarks');

Route::get('home/adminshowmarks','showsubmittedmarks@adminshowmarks')->name('adminshowmarks');
Route::get('home/addstudent','addstudent@index')->name('addstudent');

Route::Post('home/adminshowmarks/marks', 'showsubmittedmarks@admin_studentstatus')->name('admin_studentstatus');
Route::get('home/adminshowmarks/exportexcel/{course_id}','excelexport@index')->name('exportexcel');


Route::Post('home/addstudent/fetch', 'addstudent@coursefetch')->name('coursefetch');
Route::Post('home/addstudent/check', 'addstudent@check')->name('check');
Route::POST('home/addstudent/upload','addstudent@upload'); 


/// hod verify marks
Route::post('home/showsubmittedmarks/verify','hodpreviewmarks@marksverify')->name('marksverify');


// hod editing marks
Route::Post('home/showsubmittedmarks/reedit','hodpreviewmarks@reedit')->name('reedit');