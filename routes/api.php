<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\author_materialController;
use App\Http\Controllers\authorsController;
use App\Http\Controllers\editorialsController;
use App\Http\Controllers\educationLevel_materialController;
use App\Http\Controllers\educationLevelsController;
use App\Http\Controllers\material_userController;
use App\Http\Controllers\materialsController;
use App\Http\Controllers\typeMaterialsController;
use App\Http\Controllers\usersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Storage;


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



Route::get('downloadfile/{id_material}', [materialsController::class, 'documentDownload']);



Route::post('login', [AuthController::class, 'login']);


Route::group(['middleware' => ["auth:sanctum"]], function(){

    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('users', [usersController::class, 'index']);




});

//Usuarios
Route::post('users', [usersController::class, 'store']);
Route::get('users/{id_user}', [usersController::class, 'show']);
Route::put('users/{id_user}', [usersController::class, 'update']);
Route::delete('users/{id_user}', [usersController::class, 'destroy']);



//Materiales
Route::get('materials', [materialsController::class, 'index']);
Route::post('materials', [materialsController::class, 'store']);
Route::get('materials/{id_material}', [materialsController::class, 'show']);
Route::put('materials/{id_material}', [materialsController::class, 'update']);
Route::delete('materials/{id_material}', [materialsController::class, 'destroy']);


//Tipo de materiales
Route::get('typematerials', [typeMaterialsController::class, 'index']);
Route::post('typematerials', [typeMaterialsController::class, 'store']);
Route::get('typematerials/{id_typematerial}', [typeMaterialsController::class, 'show']);
Route::put('typematerials/{id_typematerial}', [typeMaterialsController::class, 'update']);
Route::delete('typematerials/{id_typematerial}', [typeMaterialsController::class, 'destroy']);


//Editoriales
Route::get('editorials', [editorialsController::class, 'index']);
Route::post('editorials', [editorialsController::class, 'store']);
Route::get('editorials/{id_editorial}', [editorialsController::class, 'show']);
Route::put('editorials/{id_editorial}', [editorialsController::class, 'update']);
Route::delete('editorials/{id_editorial}', [editorialsController::class, 'destroy']);

//Niveles educativos
Route::get('educationlevels', [educationLevelsController::class, 'index']);
Route::post('educationlevels', [educationLevelsController::class, 'store']);
Route::get('educationlevels/{id_educationlevel}', [educationLevelsController::class, 'show']);
Route::put('educationlevels/{id_educationlevel}', [educationLevelsController::class, 'update']);
Route::delete('educationlevels/{id_educationlevel}', [educationLevelsController::class, 'destroy']);

//Autores
Route::get('authors', [authorsController::class, 'index']);
Route::post('authors', [authorsController::class, 'store']);
Route::get('authors/{id_author}', [authorsController::class, 'show']);
Route::put('authors/{id_author}', [authorsController::class, 'update']);
Route::delete('authors/{id_author}', [authorsController::class, 'destroy']);

//Material - User
Route::get('materialuser', [material_userController::class, 'index']);
Route::post('materialuser', [material_userController::class, 'store']);

//Nivel educativo - Material
Route::get('edlevelmaterials', [educationLevel_materialController::class, 'index']);

//Author - Material
Route::get('authormaterials', [author_materialController::class, 'index']);
