<?php

use App\Http\Controllers\Admin\ComputedFormFieldsController;
use App\Http\Controllers\Admin\FieldCategoriesController;
use App\Http\Controllers\Admin\FormCategoriesController;
use App\Http\Controllers\Admin\FormFieldsController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\FormsController as AdminFormsController;
use App\Http\Controllers\Admin\ReportsController as AdminReportsController;
use App\Http\Controllers\Admin\FarmsController as AdminFarmsController;
use App\Http\Controllers\Admin\OrganisationsController as AdminOrganisationsController;
use App\Http\Controllers\Admin\UnitsController as AdminUnitsController;
use App\Http\Controllers\General\ContactsController;
use App\Http\Controllers\General\ProfilesController;
use App\Http\Controllers\Specialist\AnalyticsController;
use App\Http\Controllers\Specialist\FarmsController;
use App\Http\Controllers\Specialist\FarmsReportsController;
use App\Http\Controllers\Specialist\FieldTemplatesController;
use App\Http\Controllers\Specialist\FormsController;
use App\Http\Controllers\Specialist\OrganizationsController;
use App\Http\Controllers\Specialist\ReportsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

require __DIR__.'/api.php';

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

Route::get('/test', function(){
    return bcrypt('aleksey.eldashev@tatar.ru');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->middleware('verify-admin')->group(function(){
    Route::resource('users', AdminUsersController::class);
    Route::resource('forms', AdminFormsController::class);
    Route::resource('form-categories', FormCategoriesController::class);
    Route::resource('form-fields', FormFieldsController::class);
    Route::resource('computed-form-fields', ComputedFormFieldsController::class);
    Route::resource('field-categories', FieldCategoriesController::class);
    Route::resource('reports', AdminReportsController::class);
    Route::resource('organisations', AdminOrganisationsController::class);
    Route::resource('farms', AdminFarmsController::class);
    Route::resource('units', AdminUnitsController::class);
    Route::get('/test', function(){
        return '1';
    });
});

Route::prefix('specialist')->name('specialist.')->middleware('verify-specialist')->group(function(){
    Route::resource('organizations', OrganizationsController::class);
    Route::resource('farms', FarmsController::class);
    Route::resource('reports', ReportsController::class);
    Route::resource('forms', FormsController::class);
    Route::resource('farms.reports', FarmsReportsController::class);
    Route::resource('field-templates', FieldTemplatesController::class);
    Route::resource('analytics', AnalyticsController::class);
    Route::delete('reports/delete-file/{file}', [ReportsController::class, 'deleteFile'])->name('reports.delete-file');
});

Route::prefix('general')->name('general.')->middleware('role:admin|specialist|super-admin')->group(function(){
    Route::resource('contacts', ContactsController::class);
    Route::resource('profiles', ProfilesController::class);
});

Route::get('test', [\App\Http\Controllers\TestController::class, 'index'])->name('test');



