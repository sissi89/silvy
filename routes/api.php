<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::get('/books',[BookController::class, 'getAll']); 
Route::get('/students',[StudentController::class,'getStudents']);
Route::get('/students/{id}',[StudentController::class,'getStudentById']);
Route::get('/teachers',[StudentController::class,'getTeachers']);
Route::get('/teachers/{teach}',[StudentController::class,'getSubjectsOfProf']);
Route::get('/examsFalls/{subject}',[StudentController::class,'getSubjectsOfFall']);
Route::get('/avgExams/{subject}',[StudentController::class,'getAvgSubject']);
Route::get('/avgStudents/{subject}',[StudentController::class,'getAvgStudents']);
Route::get('/teachersSeveres',[StudentController::class,'getProfPlusSeveres']);
Route::get('/examsOrder/{student}',[StudentController::class,'getExamsStudent']);
Route::get('/helpstudents',[StudentController::class,'getStudentHelp']);
Route::get('/studentNerd',[StudentController::class,'getStudentNerd']);
// post
Route::post('/students',[StudentController::class,'postStudents']);
// put
Route::put('/students/{id}',[StudentController::class,'putStudents']);
// delete 
Route::delete('/students/{id}',[StudentController::class,'deleteStudent']);
