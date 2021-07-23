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

//120b. Added sort route
Route::get('/professors/sort', 'ProfessorController@sort');

//105. Added route to add initials
//Route::get('/addInitials', 'ProfessorController@addInitials');

Route::get('/', function () {
    //131. Send Universities for search purposes
    $universities = App\University::all();
    return view('welcome', ['universities'=>$universities]);

});

//99. Added route to department_university.blade.php
//Route::get('/department_university', 'DepartmentController@departmentUniversity');
//109. Fixed route to department university
//137. added exceptions for show, edit, update and destroy
Route::resource('department_university', 'DepartmentUniversityController')->except('show', 'edit', 'update', 'destroy');

//47. Add route to approve professor
Route::get('/professors/approve', 'ProfessorController@approve');

//80. Added route to mass creation of professor function
Route::get('/professors/masscreation', 'ProfessorController@masscreation');
//81. Added route to mass create professor process function
Route::post('/professors/masscreate', 'ProfessorController@masscreate')->name('massCreateProfessors');

//18. defining route to professor controller
Route::resource('professors', 'ProfessorController');// 78. removed middleware ->middleware('checkprof');      //71. added middleware

//19. defining route to review controller for create method
Route::get('/professors/{professor_id}/review', 'ReviewController@create');

// MASS UPDATE [forgot to number]
Route::post('/reviews/massUpdate', 'ReviewController@massUpdate')->name('massUpdateReviews');
//48. Mass update professor:
Route::post('/professors/massUpdate', 'ProfessorController@massUpdate')->name('massUpdateProfessors');

//35. Add route to approve review
Route::get('/reviews/approve', 'ReviewController@approve');

//20. defining route to review controller for store method
Route::resource('reviews', 'ReviewController');
//95. Disabled registration
Auth::routes(['register' => false]);

//26. added search route:
//29. added middleware 'searchprof' (check App\Http\kernel.php)
Route::any('/professors/search', 'ProfessorController@search');

//51. Added routes to universities controller
Route::resource('universities', 'UniversityController');

//53. Added routes to departments controller
Route::resource('departments', 'DepartmentController');

Route::get('/home', 'HomeController@index')->name('home');

//94. Added route to how to page
Route::get('/help', function () {
    return view('help');
});