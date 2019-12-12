<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('users', 'Users\UserController')->except(['create','edit']);

Route::resource('staffs', 'Staffs\StaffController')->except(['create','edit']);
// Route::resource('staffs.streams', 'Staffs\StaffStreamController', ['only' => ['index']]);
// Route::resource('staffs.levels', 'Staffs\StaffLevelController', ['only' => ['index']]);
// Route::resource('staffs.subjects', 'Staffs\StaffSubjectController', ['only' => ['index']]);

Route::resource('students', 'Students\StudentController')->except(['create','edit']);
Route::post('level', 'Students\StudentController@level')->name('level');
Route::get('level', 'Students\StudentController@level')->name('level');
// Route::resource('students.streams', 'Students\StudentStreamController', ['only' => ['index']]);
Route::resource('students.levels', 'Students\StudentLevelController', ['only' => ['index']]);

Route::resource('students.levels.results', 'Students\StudentLevelResultController', ['only' => ['index']]);

// Route::resource('students.results', 'Students\StudentResultController', ['only' => ['index']]);
// Route::resource('students.subjects', 'Students\StudentSubjectController', ['only' => ['index']]);

Route::resource('subjects', 'Subjects\SubjectController')->except(['create','edit']);
// Route::resource('subjects.streams', 'Subjects\SubjectStreamController', ['only' => ['index']]);
// Route::resource('subjects.levels', 'Subjects\SubjectLevelController', ['only' => ['index']]);
// Route::resource('subjects.results', 'Subjects\SubjectResultController', ['only' => ['index']]);
// Route::resource('subjects.students', 'Subjects\SubjectSubjectController', ['only' => ['index']]);


Route::resource('streams', 'Streams\StreamController')->except(['create','edit']);
// Route::resource('streams.streams', 'Streams\StreamController', ['only' => ['index']]);
// Route::resource('streams.levels', 'Streams\StreamLevelController', ['only' => ['index']]);
// Route::resource('streams.results', 'Streams\StreamResultController', ['only' => ['index']]);
// Route::resource('streams.subjects', 'Streams\StreamSubjectController', ['only' => ['index']]);

Route::resource('levels', 'Levels\LevelController')->except(['create','edit']);
// Route::resource('levels.streams', 'Levels\LevelStreamController', ['only' => ['index']]);
// Route::resource('levels.levels', 'Levels\LevelLevelController', ['only' => ['index']]);
// Route::resource('levels.results', 'Levels\LevelResultController', ['only' => ['index']]);
// Route::resource('levels.subjects', 'Levels\LevelSubjectController', ['only' => ['index']]);

//Route::resource('results', 'Results\ResultController')->except(['create','edit']);
// Route::get('studentresult', 'Results\AllResultController@studentresult')->name('studentresult');
