<?php

use App\Http\Controllers\Api\v1\ContactsController;
use App\Http\Controllers\Api\v1\DistrictsController;
use App\Http\Controllers\Api\v1\FarmsController;
use App\Http\Controllers\Api\v1\FieldTemplatesController;
use App\Http\Controllers\Api\v1\FormCategoriesController;
use App\Http\Controllers\Api\v1\FormFieldsController;
use App\Http\Controllers\Api\v1\FormsController;
use App\Http\Controllers\Api\v1\OrganisationsController;
use App\Http\Controllers\Api\v1\ProfilesController;
use App\Http\Controllers\Api\v1\RegionsController;
use App\Http\Controllers\Api\v1\ReportsController;
use App\Http\Controllers\Api\v1\RolesController;
use App\Http\Controllers\Api\v1\UsersController;
use App\Http\Controllers\Api\v1\PasswordResetsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('logout', 'App\Http\Controllers\Api\v1\ApiLoginController@logout');

    // Получение всех записей с проверкой на токен
    Route::get('farms', 'App\Http\Controllers\Api\v1\FarmController@index');
    Route::get('contacts', 'App\Http\Controllers\Api\v1\ContactsController@index');
    Route::get('districts', 'App\Http\Controllers\Api\v1\DistrictsController@index');
    Route::get('fieldtemplates', 'App\Http\Controllers\Api\v1\FieldTemplatesController@index');
    Route::get('formcategories', 'App\Http\Controllers\Api\v1\FormCategoriesController@index');
    Route::get('formfields', 'App\Http\Controllers\Api\v1\FormFieldsController@index');
    Route::get('forms', 'App\Http\Controllers\Api\v1\FormsController@index');
    Route::get('organisations', 'App\Http\Controllers\Api\v1\OrganisationsController@index');
    Route::get('profiles', 'App\Http\Controllers\Api\v1\ProfilesController@index');
    Route::get('regions', 'App\Http\Controllers\Api\v1\RegionsController@index');
    Route::get('reports', 'App\Http\Controllers\Api\v1\ReportsController@index');
    Route::get('roles', 'App\Http\Controllers\Api\v1\RolesController@index');
    Route::get('farms', 'App\Http\Controllers\Api\v1\FarmController@index');
    Route::get('media', 'App\Http\Controllers\Api\v1\MediaController@index');
    Route::get('users', 'App\Http\Controllers\Api\v1\UsersController@index');
    Route::get('passwordresets', 'App\Http\Controllers\Api\v1\PasswordResetsController@index');

    // UpdateOrCreate
    Route::post('media_update/{id}', 'App\Http\Controllers\Api\v1\MediaController@updateOrCreate');
    Route::post('users_update/{id}', 'App\Http\Controllers\Api\v1\UsersController@updateOrCreate');
    Route::post('contacts_update/{id}', 'App\Http\Controllers\Api\v1\ContactsController@updateOrCreate');
    Route::post('districts_update/{id}', 'App\Http\Controllers\Api\v1\DistrictsController@updateOrCreate');
    Route::post('farms_update/{id}', 'App\Http\Controllers\Api\v1\FarmController@updateOrCreate');
    Route::post('fieldtemplates_update/{id}', 'App\Http\Controllers\Api\v1\FieldTemplatesController@updateOrCreate');
    Route::post('formcategories_update/{id}', 'App\Http\Controllers\Api\v1\FormCategoriesController@updateOrCreate');
    Route::post('formfields_update/{id}', 'App\Http\Controllers\Api\v1\FormFieldsController@updateOrCreate');
    Route::post('organisations_update/{id}', 'App\Http\Controllers\Api\v1\OrganisationsController@updateOrCreate');
    Route::post('reports_update/{id}', 'App\Http\Controllers\Api\v1\ReportsController@updateOrCreate');
    Route::post('regions_update/{id}', 'App\Http\Controllers\Api\v1\RegionsController@updateOrCreate');

    // Загрузка медиа
    Route::post('media_get', 'App\Http\Controllers\Api\v1\MediaController@store');

    // Скачивание медиа
    Route::get('media_download/{id}', 'App\Http\Controllers\Api\v1\MediaController@download');

    // Удаление медиа
    Route::delete('media_delete/{id}', 'App\Http\Controllers\Api\v1\MediaController@destroy');
});

// Восстановление пароля
Route::post('passwordresets_update/{email}', 'App\Http\Controllers\Api\v1\PasswordResetsController@updateOrCreate');
Route::post('/password/reset', [PasswordResetsController::class, 'sendResetLinkEmail'])->name('password.email');

// Login and Register
Route::post('login', 'App\Http\Controllers\Api\v1\ApiLoginController@login');
Route::post('register', 'App\Http\Controllers\Api\v1\ApiLoginController@register');
