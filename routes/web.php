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

Route::get('/class/list', 'ClassController@myClasses')->name('my.class');
Route::get('/listing', 'ClassController@list')->name('class.listing');
Route::get('/class/{classId}', 'ClassController@showClass')->name('show.class');
Route::post('/class/join', 'ClassController@joinClass')->name('join.class');
// submit assignments route
Route::get('/assignment/submit/{id}', 'AssignmentController@submitAssignment')->name('assignment.submit');
Route::post('/assignment/submit/{id}', 'AssignmentController@saveAssignment')->name('submit.assignment.final');

// Lecturers Routes
Route::get('/lecturer/home', 'LecturerController@index')->name('lecturer.home');

// create assignment -- Lecturer
Route::get('/assignment', 'AssignmentController@createAssignment')->name('create.assignment')->middleware(['auth', 'lecturer']);
Route::post('/assignment', 'AssignmentController@storeAssignment')->name('store.assignment')->middleware(['auth', 'lecturer']);
// View Assingments per class
Route::get('/lecturer/assignments/{id}', 'AssignmentController@viewAssignmentsPerClass');
Route::get('/assignments/submitted/{id}', 'AssignmentController@viewAssignmentSubmissions')->name('see.submission');

Route::get('/lecturer/classes', 'LecturerController@classes')->name('lecturer.classes');
Route::get('/lecturer/newclass', 'LecturerController@newClass')->name('new.class');
Route::post('/lecturer/createClass', 'LecturerController@createClass')->name('create.class');



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

