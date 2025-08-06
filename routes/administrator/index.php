<?php

use Illuminate\Support\Facades\Route;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;

Route::get('/admin', 'App\Http\Controllers\Admin\AdminController@loginAdmin')->name('login');
Route::post('/admin', 'App\Http\Controllers\Admin\AdminController@postLoginAdmin')->name('postLoginAdmin');

Route::get('/admin/logout', [
    'as' => 'administrator.logout',
    'uses' => '\App\Http\Controllers\Admin\AdminController@logout'
]);

Route::group(['prefix' => 'administrator', 'middleware' => ['cacheResponse:600']], function () {
    Route::prefix('password')->group(function () {
        Route::get('/', [
            'as' => 'administrator.password.index',
            'uses' => 'App\Http\Controllers\Admin\AdminController@password',
        ]);
        Route::put('/', [
            'as' => 'administrator.password.update',
            'uses' => 'App\Http\Controllers\Admin\AdminController@updatePassword',
        ]);
    });

    Route::prefix('health')->group(function () {
        Route::get('/', HealthCheckResultsController::class)->name('administrator.dashboard.health');
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [
            'as' => 'administrator.dashboard.index',
            'uses' => 'App\Http\Controllers\Admin\DashboardController@index',
        ]);
    });

    Route::prefix('history-datas')->group(function () {
        Route::get('/', [
            'as' => 'administrator.history_data.index',
            'uses' => 'App\Http\Controllers\Admin\HistoryDataController@index',
            'middleware' => 'can:history_datas-list',
        ]);
    });

    Route::prefix('logos')->group(function () {
        Route::get('/', [
            'as' => 'administrator.logos.add',
            'uses' => 'App\Http\Controllers\Admin\LogoController@create',
            'middleware' => 'can:logos-list',
        ]);

        Route::post('/store', [
            'as' => 'administrator.logos.store',
            'uses' => 'App\Http\Controllers\Admin\LogoController@store',
            'middleware' => 'can:logos-add',
        ]);
    });

    Route::prefix('users')->group(function () {

        Route::get('/', [
            'as' => 'administrator.users.index',
            'uses' => 'App\Http\Controllers\Admin\UserController@index',
            'middleware' => 'can:users-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.users.create',
            'uses' => 'App\Http\Controllers\Admin\UserController@create',
            'middleware' => 'can:users-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.users.store',
            'uses' => 'App\Http\Controllers\Admin\UserController@store',
            'middleware' => 'can:users-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.users.edit',
            'uses' => 'App\Http\Controllers\Admin\UserController@edit',
            'middleware' => 'can:users-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.users.update',
            'uses' => 'App\Http\Controllers\Admin\UserController@update',
            'middleware' => 'can:users-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.users.delete',
            'uses' => 'App\Http\Controllers\Admin\UserController@delete',
            'middleware' => 'can:users-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.users.restore',
            'uses' => 'App\Http\Controllers\Admin\UserController@restore',
            'middleware' => 'can:users-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.users.delete_many',
            'uses' => 'App\Http\Controllers\Admin\UserController@deleteManyByIds',
            'middleware' => 'can:users-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.users.export',
            'uses' => 'App\Http\Controllers\Admin\UserController@export',
            'middleware' => 'can:users-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.users.audit',
            'uses' => 'App\Http\Controllers\Admin\UserController@audit',
            'middleware' => 'can:users-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.users.get',
            'uses' => 'App\Http\Controllers\Admin\UserController@get',
            'middleware' => 'can:users-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.users.sort',
            'uses' => 'App\Http\Controllers\Admin\UserController@sort',
            'middleware' => 'can:users-edit',
        ]);
    });

    Route::prefix('chats')->group(function () {
        Route::get('/', [
            'as' => 'administrator.chats.index',
            'uses' => 'App\Http\Controllers\Admin\ChatController@index',
            'middleware' => 'can:chats-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.chats.create',
            'uses' => 'App\Http\Controllers\Admin\ChatController@create',
            'middleware' => 'can:chats-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.chats.store',
            'uses' => 'App\Http\Controllers\Admin\ChatController@store',
            'middleware' => 'can:chats-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.chats.edit',
            'uses' => 'App\Http\Controllers\Admin\ChatController@edit',
            'middleware' => 'can:chats-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.chats.update',
            'uses' => 'App\Http\Controllers\Admin\ChatController@update',
            'middleware' => 'can:chats-edit',
        ]);

        Route::get('/delete/{id}', [
            'as' => 'administrator.chats.delete',
            'uses' => 'App\Http\Controllers\Admin\ChatController@delete',
            'middleware' => 'can:chats-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.chats.delete_many',
            'uses' => 'App\Http\Controllers\Admin\ChatController@deleteManyByIds',
            'middleware' => 'can:chats-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.chats.export',
            'uses' => 'App\Http\Controllers\Admin\ChatController@export',
            'middleware' => 'can:chats-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.chats.audit',
            'uses' => 'App\Http\Controllers\Admin\ChatController@audit',
            'middleware' => 'can:chats-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.chats.get',
            'uses' => 'App\Http\Controllers\Admin\ChatController@get',
            'middleware' => 'can:chats-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.chats.sort',
            'uses' => 'App\Http\Controllers\Admin\ChatController@sort',
            'middleware' => 'can:chats-edit',
        ]);
    });

    Route::prefix('employees')->group(function () {
        Route::get('/', [
            'as' => 'administrator.employees.index',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@index',
            'middleware' => 'can:employees-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.employees.create',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@create',
            'middleware' => 'can:employees-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.employees.store',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@store',
            'middleware' => 'can:employees-add',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.employees.update',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@update',
            'middleware' => 'can:employees-edit',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.employees.edit',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@edit',
            'middleware' => 'can:employees-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.employees.delete',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@delete',
            'middleware' => 'can:employees-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.employees.restore',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@restore',
            'middleware' => 'can:employees-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.employees.delete_many',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@deleteManyByIds',
            'middleware' => 'can:employees-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.employees.export',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@export',
            'middleware' => 'can:employees-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.employees.audit',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@audit',
            'middleware' => 'can:employees-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.employees.get',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@get',
            'middleware' => 'can:employees-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.employees.sort',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@sort',
            'middleware' => 'can:employees-edit',
        ]);
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' => 'administrator.roles.index',
            'uses' => 'App\Http\Controllers\Admin\RoleController@index',
            'middleware' => 'can:roles-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.roles.create',
            'uses' => 'App\Http\Controllers\Admin\RoleController@create',
            'middleware' => 'can:roles-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.roles.edit',
            'uses' => 'App\Http\Controllers\Admin\RoleController@edit',
            'middleware' => 'can:roles-edit',
        ]);

        Route::post('/store', [
            'as' => 'administrator.roles.store',
            'uses' => 'App\Http\Controllers\Admin\RoleController@store',
            'middleware' => 'can:roles-add',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.roles.update',
            'uses' => 'App\Http\Controllers\Admin\RoleController@update',
            'middleware' => 'can:roles-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.roles.delete',
            'uses' => 'App\Http\Controllers\Admin\RoleController@delete',
            'middleware' => 'can:roles-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.roles.restore',
            'uses' => 'App\Http\Controllers\Admin\RoleController@restore',
            'middleware' => 'can:roles-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.roles.delete_many',
            'uses' => 'App\Http\Controllers\Admin\RoleController@deleteManyByIds',
            'middleware' => 'can:roles-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.roles.export',
            'uses' => 'App\Http\Controllers\Admin\RoleController@export',
            'middleware' => 'can:roles-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.roles.audit',
            'uses' => 'App\Http\Controllers\Admin\RoleController@audit',
            'middleware' => 'can:roles-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.roles.get',
            'uses' => 'App\Http\Controllers\Admin\RoleController@get',
            'middleware' => 'can:roles-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.roles.sort',
            'uses' => 'App\Http\Controllers\Admin\RoleController@sort',
            'middleware' => 'can:roles-edit',
        ]);
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/create', [
            'as' => 'administrator.permissions.create',
            'uses' => 'App\Http\Controllers\Admin\PermissionController@create',
            'middleware' => 'can:permissions-list',
        ]);

        Route::post('/store', [
            'as' => 'administrator.permissions.store',
            'uses' => 'App\Http\Controllers\Admin\PermissionController@store',
            'middleware' => 'can:permissions-add',
        ]);
    });

    Route::prefix('sliders')->group(function () {
        Route::get('/', [
            'as' => 'administrator.sliders.index',
            'uses' => 'App\Http\Controllers\Admin\SliderController@index',
            'middleware' => 'can:sliders-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.sliders.create',
            'uses' => 'App\Http\Controllers\Admin\SliderController@create',
            'middleware' => 'can:sliders-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.sliders.store',
            'uses' => 'App\Http\Controllers\Admin\SliderController@store',
            'middleware' => 'can:sliders-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.sliders.edit',
            'uses' => 'App\Http\Controllers\Admin\SliderController@edit',
            'middleware' => 'can:sliders-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.sliders.update',
            'uses' => 'App\Http\Controllers\Admin\SliderController@update',
            'middleware' => 'can:sliders-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.sliders.delete',
            'uses' => 'App\Http\Controllers\Admin\SliderController@delete',
            'middleware' => 'can:sliders-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.sliders.restore',
            'uses' => 'App\Http\Controllers\Admin\SliderController@restore',
            'middleware' => 'can:sliders-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.sliders.delete_many',
            'uses' => 'App\Http\Controllers\Admin\SliderController@deleteManyByIds',
            'middleware' => 'can:sliders-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.sliders.export',
            'uses' => 'App\Http\Controllers\Admin\SliderController@export',
            'middleware' => 'can:sliders-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.sliders.audit',
            'uses' => 'App\Http\Controllers\Admin\SliderController@audit',
            'middleware' => 'can:sliders-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.sliders.get',
            'uses' => 'App\Http\Controllers\Admin\SliderController@get',
            'middleware' => 'can:sliders-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.sliders.sort',
            'uses' => 'App\Http\Controllers\Admin\SliderController@sort',
            'middleware' => 'can:sliders-edit',
        ]);
    });

    Route::prefix('news')->group(function () {
        Route::get('/', [
            'as' => 'administrator.news.index',
            'uses' => 'App\Http\Controllers\Admin\NewsController@index',
            'middleware' => 'can:news-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.news.create',
            'uses' => 'App\Http\Controllers\Admin\NewsController@create',
            'middleware' => 'can:news-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.news.store',
            'uses' => 'App\Http\Controllers\Admin\NewsController@store',
            'middleware' => 'can:news-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.news.edit',
            'uses' => 'App\Http\Controllers\Admin\NewsController@edit',
            'middleware' => 'can:news-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.news.update',
            'uses' => 'App\Http\Controllers\Admin\NewsController@update',
            'middleware' => 'can:news-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.news.delete',
            'uses' => 'App\Http\Controllers\Admin\NewsController@delete',
            'middleware' => 'can:news-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.news.restore',
            'uses' => 'App\Http\Controllers\Admin\NewsController@restore',
            'middleware' => 'can:news-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.news.delete_many',
            'uses' => 'App\Http\Controllers\Admin\NewsController@deleteManyByIds',
            'middleware' => 'can:news-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.news.export',
            'uses' => 'App\Http\Controllers\Admin\NewsController@export',
            'middleware' => 'can:news-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.news.audit',
            'uses' => 'App\Http\Controllers\Admin\NewsController@audit',
            'middleware' => 'can:news-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.news.get',
            'uses' => 'App\Http\Controllers\Admin\NewsController@get',
            'middleware' => 'can:news-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.news.sort',
            'uses' => 'App\Http\Controllers\Admin\NewsController@sort',
            'middleware' => 'can:news-edit',
        ]);
    });

    Route::prefix('job-emails')->group(function () {
        Route::get('/', [
            'as' => 'administrator.job_emails.index',
            'uses' => 'App\Http\Controllers\Admin\JobEmailController@index',
            'middleware' => 'can:job_emails-list',
        ]);

        Route::post('/store', [
            'as' => 'administrator.job_emails.store',
            'uses' => 'App\Http\Controllers\Admin\JobEmailController@store',
            'middleware' => 'can:job_emails-add',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.job_emails.delete',
            'uses' => 'App\Http\Controllers\Admin\JobEmailController@delete',
            'middleware' => 'can:job_emails-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.job_emails.restore',
            'uses' => 'App\Http\Controllers\Admin\JobEmailController@restore',
            'middleware' => 'can:job_emails-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.job_emails.delete_many',
            'uses' => 'App\Http\Controllers\Admin\JobEmailController@deleteManyByIds',
            'middleware' => 'can:job_emails-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.job_emails.export',
            'uses' => 'App\Http\Controllers\Admin\JobEmailController@export',
            'middleware' => 'can:job_emails-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.job_emails.audit',
            'uses' => 'App\Http\Controllers\Admin\JobEmailController@audit',
            'middleware' => 'can:job_emails-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.job_emails.get',
            'uses' => 'App\Http\Controllers\Admin\JobEmailController@get',
            'middleware' => 'can:job_emails-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.job_emails.sort',
            'uses' => 'App\Http\Controllers\Admin\JobEmailController@sort',
            'middleware' => 'can:job_emails-edit',
        ]);
    });

    Route::prefix('job-notifications')->group(function () {
        Route::get('/', [
            'as' => 'administrator.job_notifications.index',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@index',
            'middleware' => 'can:job_notifications-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.job_notifications.create',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@create',
            'middleware' => 'can:job_notifications-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.job_notifications.store',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@store',
            'middleware' => 'can:job_notifications-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.job_notifications.edit',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@edit',
            'middleware' => 'can:job_notifications-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.job_notifications.update',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@update',
            'middleware' => 'can:job_notifications-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.job_notifications.delete',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@delete',
            'middleware' => 'can:job_notifications-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.job_notifications.restore',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@restore',
            'middleware' => 'can:job_notifications-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.job_notifications.delete_many',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@deleteManyByIds',
            'middleware' => 'can:job_notifications-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.job_notifications.export',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@export',
            'middleware' => 'can:job_notifications-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.job_notifications.audit',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@audit',
            'middleware' => 'can:job_notifications-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.job_notifications.get',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@get',
            'middleware' => 'can:job_notifications-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.job_notifications.sort',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@sort',
            'middleware' => 'can:job_notifications-edit',
        ]);
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as' => 'administrator.categories.index',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@index',
            'middleware' => 'can:categories-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.categories.create',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@create',
            'middleware' => 'can:categories-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.categories.store',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@store',
            'middleware' => 'can:categories-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.categories.edit',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@edit',
            'middleware' => 'can:categories-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.categories.update',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@update',
            'middleware' => 'can:categories-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.categories.delete',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@delete',
            'middleware' => 'can:categories-delete',
        ]);

        Route::post('/categories/{id}', [
            'as' => 'administrator.categories.restore',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@restore',
            'middleware' => 'can:categories-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.categories.delete_many',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@deleteManyByIds',
            'middleware' => 'can:categories-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.categories.export',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@export',
            'middleware' => 'can:categories-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.categories.audit',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@audit',
            'middleware' => 'can:categories-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.categories.get',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@get',
            'middleware' => 'can:categories-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.categories.sort',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@sort',
            'middleware' => 'can:categories-edit',
        ]);
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [
            'as' => 'administrator.products.index',
            'uses' => 'App\Http\Controllers\Admin\ProductController@index',
            'middleware' => 'can:products-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.products.create',
            'uses' => 'App\Http\Controllers\Admin\ProductController@create',
            'middleware' => 'can:products-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.products.store',
            'uses' => 'App\Http\Controllers\Admin\ProductController@store',
            'middleware' => 'can:products-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.products.edit',
            'uses' => 'App\Http\Controllers\Admin\ProductController@edit',
            'middleware' => 'can:products-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.products.update',
            'uses' => 'App\Http\Controllers\Admin\ProductController@update',
            'middleware' => 'can:products-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.products.delete',
            'uses' => 'App\Http\Controllers\Admin\ProductController@delete',
            'middleware' => 'can:products-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.products.restore',
            'uses' => 'App\Http\Controllers\Admin\ProductController@restore',
            'middleware' => 'can:products-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.products.delete_many',
            'uses' => 'App\Http\Controllers\Admin\ProductController@deleteManyByIds',
            'middleware' => 'can:products-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.products.export',
            'uses' => 'App\Http\Controllers\Admin\ProductController@export',
            'middleware' => 'can:products-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.products.audit',
            'uses' => 'App\Http\Controllers\Admin\ProductController@audit',
            'middleware' => 'can:products-list',
        ]);

        Route::post('/import', [
            'as' => 'administrator.products.import',
            'uses' => 'App\Http\Controllers\Admin\ProductController@import',
            'middleware' => 'can:products-add',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.products.get',
            'uses' => 'App\Http\Controllers\Admin\ProductController@get',
            'middleware' => 'can:products-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.products.sort',
            'uses' => 'App\Http\Controllers\Admin\ProductController@sort',
            'middleware' => 'can:products-edit',
        ]);
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as' => 'administrator.settings.index',
            'uses' => 'App\Http\Controllers\Admin\SettingController@index',
            'middleware' => 'can:settings-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.settings.create',
            'uses' => 'App\Http\Controllers\Admin\SettingController@create',
            'middleware' => 'can:settings-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.settings.store',
            'uses' => 'App\Http\Controllers\Admin\SettingController@store',
            'middleware' => 'can:settings-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.settings.edit',
            'uses' => 'App\Http\Controllers\Admin\SettingController@edit',
            'middleware' => 'can:settings-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.settings.update',
            'uses' => 'App\Http\Controllers\Admin\SettingController@update',
            'middleware' => 'can:settings-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.settings.delete',
            'uses' => 'App\Http\Controllers\Admin\SettingController@delete',
            'middleware' => 'can:settings-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.settings.restore',
            'uses' => 'App\Http\Controllers\Admin\SettingController@restore',
            'middleware' => 'can:settings-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.settings.delete_many',
            'uses' => 'App\Http\Controllers\Admin\SettingController@deleteManyByIds',
            'middleware' => 'can:settings-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.settings.export',
            'uses' => 'App\Http\Controllers\Admin\SettingController@export',
            'middleware' => 'can:settings-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.settings.audit',
            'uses' => 'App\Http\Controllers\Admin\SettingController@audit',
            'middleware' => 'can:settings-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.settings.get',
            'uses' => 'App\Http\Controllers\Admin\SettingController@get',
            'middleware' => 'can:settings-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.settings.sort',
            'uses' => 'App\Http\Controllers\Admin\SettingController@sort',
            'middleware' => 'can:settings-edit',
        ]);
    });

    Route::prefix('category-news')->group(function () {
        Route::get('/', [
            'as' => 'administrator.category_news.index',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@index',
            'middleware' => 'can:category_news-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.category_news.create',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@create',
            'middleware' => 'can:category_news-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.category_news.store',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@store',
            'middleware' => 'can:category_news-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.category_news.edit',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@edit',
            'middleware' => 'can:category_news-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.category_news.update',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@update',
            'middleware' => 'can:category_news-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.category_news.delete',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@delete',
            'middleware' => 'can:category_news-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.category_news.restore',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@restore',
            'middleware' => 'can:category_news-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.category_news.delete_many',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@deleteManyByIds',
            'middleware' => 'can:category_news-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.category_news.export',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@export',
            'middleware' => 'can:category_news-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.category_news.audit',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@audit',
            'middleware' => 'can:category_news-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.category_news.get',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@get',
            'middleware' => 'can:category_news-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.category_news.sort',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@sort',
            'middleware' => 'can:category_news-edit',
        ]);
    });

    Route::prefix('system-branches')->group(function () {
        Route::get('/', [
            'as' => 'administrator.system_branches.index',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@index',
            'middleware' => 'can:system_branches-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.system_branches.create',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@create',
            'middleware' => 'can:system_branches-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.system_branches.store',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@store',
            'middleware' => 'can:system_branches-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.system_branches.edit',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@edit',
            'middleware' => 'can:system_branches-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.system_branches.update',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@update',
            'middleware' => 'can:system_branches-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.system_branches.delete',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@delete',
            'middleware' => 'can:system_branches-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.system_branches.restore',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@restore',
            'middleware' => 'can:system_branches-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.system_branches.delete_many',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@deleteManyByIds',
            'middleware' => 'can:system_branches-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.system_branches.export',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@export',
            'middleware' => 'can:system_branches-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.system_branches.audit',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@audit',
            'middleware' => 'can:system_branches-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.system_branches.get',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@get',
            'middleware' => 'can:system_branches-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.system_branches.sort',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@sort',
            'middleware' => 'can:system_branches-edit',
        ]);
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [
            'as' => 'administrator.orders.index',
            'uses' => 'App\Http\Controllers\Admin\OrderController@index',
            'middleware' => 'can:orders-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.orders.create',
            'uses' => 'App\Http\Controllers\Admin\OrderController@create',
            'middleware' => 'can:orders-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.orders.store',
            'uses' => 'App\Http\Controllers\Admin\OrderController@store',
            'middleware' => 'can:orders-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.orders.edit',
            'uses' => 'App\Http\Controllers\Admin\OrderController@edit',
            'middleware' => 'can:orders-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.orders.update',
            'uses' => 'App\Http\Controllers\Admin\OrderController@update',
            'middleware' => 'can:orders-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.orders.delete',
            'uses' => 'App\Http\Controllers\Admin\OrderController@delete',
            'middleware' => 'can:orders-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.orders.restore',
            'uses' => 'App\Http\Controllers\Admin\OrderController@restore',
            'middleware' => 'can:orders-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.orders.delete_many',
            'uses' => 'App\Http\Controllers\Admin\OrderController@deleteManyByIds',
            'middleware' => 'can:orders-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.orders.export',
            'uses' => 'App\Http\Controllers\Admin\OrderController@export',
            'middleware' => 'can:orders-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.orders.audit',
            'uses' => 'App\Http\Controllers\Admin\OrderController@audit',
            'middleware' => 'can:orders-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.orders.import',
            'uses' => 'App\Http\Controllers\Admin\OrderController@import',
            'middleware' => 'can:orders-list',
        ]);

        Route::get('/print/{id}', [
            'as' => 'administrator.orders.print',
            'uses' => 'App\Http\Controllers\Admin\OrderController@print',
            'middleware' => 'can:orders-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.orders.get',
            'uses' => 'App\Http\Controllers\Admin\OrderController@get',
            'middleware' => 'can:orders-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.orders.sort',
            'uses' => 'App\Http\Controllers\Admin\OrderController@sort',
            'middleware' => 'can:orders-edit',
        ]);
    });

    Route::prefix('vouchers')->group(function () {
        Route::get('/', [
            'as' => 'administrator.vouchers.index',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@index',
            'middleware' => 'can:vouchers-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.vouchers.create',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@create',
            'middleware' => 'can:vouchers-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.vouchers.store',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@store',
            'middleware' => 'can:vouchers-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.vouchers.edit',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@edit',
            'middleware' => 'can:vouchers-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.vouchers.update',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@update',
            'middleware' => 'can:vouchers-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.vouchers.delete',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@delete',
            'middleware' => 'can:vouchers-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.vouchers.restore',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@restore',
            'middleware' => 'can:vouchers-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.vouchers.delete_many',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@deleteManyByIds',
            'middleware' => 'can:vouchers-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.vouchers.export',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@export',
            'middleware' => 'can:vouchers-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.vouchers.audit',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@audit',
            'middleware' => 'can:vouchers-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.vouchers.import',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@import',
            'middleware' => 'can:vouchers-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.vouchers.get',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@get',
            'middleware' => 'can:vouchers-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.vouchers.sort',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@sort',
            'middleware' => 'can:vouchers-edit',
        ]);
    });

    Route::prefix('medias')->group(function () {

        Route::get('/', [
            'as' => 'administrator.medias.index',
            'uses' => 'App\Http\Controllers\Admin\MediaController@index',
            'middleware' => 'can:medias-list',
        ]);
    });

    Route::prefix('payment-methods')->group(function () {
        Route::get('/', [
            'as' => 'administrator.payment_methods.index',
            'uses' => 'App\Http\Controllers\Admin\PaymentMethodController@index',
            'middleware' => 'can:payment_methods-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.payment_methods.create',
            'uses' => 'App\Http\Controllers\Admin\PaymentMethodController@create',
            'middleware' => 'can:payment_methods-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.payment_methods.store',
            'uses' => 'App\Http\Controllers\Admin\PaymentMethodController@store',
            'middleware' => 'can:payment_methods-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.payment_methods.edit',
            'uses' => 'App\Http\Controllers\Admin\PaymentMethodController@edit',
            'middleware' => 'can:payment_methods-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.payment_methods.update',
            'uses' => 'App\Http\Controllers\Admin\PaymentMethodController@update',
            'middleware' => 'can:payment_methods-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.payment_methods.delete',
            'uses' => 'App\Http\Controllers\Admin\PaymentMethodController@delete',
            'middleware' => 'can:payment_methods-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.payment_methods.restore',
            'uses' => 'App\Http\Controllers\Admin\PaymentMethodController@restore',
            'middleware' => 'can:payment_methods-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.payment_methods.delete_many',
            'uses' => 'App\Http\Controllers\Admin\PaymentMethodController@deleteManyByIds',
            'middleware' => 'can:payment_methods-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.payment_methods.export',
            'uses' => 'App\Http\Controllers\Admin\PaymentMethodController@export',
            'middleware' => 'can:payment_methods-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.payment_methods.audit',
            'uses' => 'App\Http\Controllers\Admin\PaymentMethodController@audit',
            'middleware' => 'can:payment_methods-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.payment_methods.import',
            'uses' => 'App\Http\Controllers\Admin\PaymentMethodController@import',
            'middleware' => 'can:payment_methods-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.payment_methods.get',
            'uses' => 'App\Http\Controllers\Admin\PaymentMethodController@get',
            'middleware' => 'can:payment_methods-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.payment_methods.sort',
            'uses' => 'App\Http\Controllers\Admin\PaymentMethodController@sort',
            'middleware' => 'can:payment_methods-edit',
        ]);
    });

    Route::prefix('user-transactions')->group(function () {
        Route::get('/', [
            'as' => 'administrator.user_transactions.index',
            'uses' => 'App\Http\Controllers\Admin\UserTransactionController@index',
            'middleware' => 'can:user_transactions-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.user_transactions.create',
            'uses' => 'App\Http\Controllers\Admin\UserTransactionController@create',
            'middleware' => 'can:user_transactions-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.user_transactions.store',
            'uses' => 'App\Http\Controllers\Admin\UserTransactionController@store',
            'middleware' => 'can:user_transactions-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.user_transactions.edit',
            'uses' => 'App\Http\Controllers\Admin\UserTransactionController@edit',
            'middleware' => 'can:user_transactions-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.user_transactions.update',
            'uses' => 'App\Http\Controllers\Admin\UserTransactionController@update',
            'middleware' => 'can:user_transactions-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.user_transactions.delete',
            'uses' => 'App\Http\Controllers\Admin\UserTransactionController@delete',
            'middleware' => 'can:user_transactions-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.user_transactions.restore',
            'uses' => 'App\Http\Controllers\Admin\UserTransactionController@restore',
            'middleware' => 'can:user_transactions-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.user_transactions.delete_many',
            'uses' => 'App\Http\Controllers\Admin\UserTransactionController@deleteManyByIds',
            'middleware' => 'can:user_transactions-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.user_transactions.export',
            'uses' => 'App\Http\Controllers\Admin\UserTransactionController@export',
            'middleware' => 'can:user_transactions-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.user_transactions.audit',
            'uses' => 'App\Http\Controllers\Admin\UserTransactionController@audit',
            'middleware' => 'can:user_transactions-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.user_transactions.import',
            'uses' => 'App\Http\Controllers\Admin\UserTransactionController@import',
            'middleware' => 'can:user_transactions-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.user_transactions.get',
            'uses' => 'App\Http\Controllers\Admin\UserTransactionController@get',
            'middleware' => 'can:user_transactions-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.user_transactions.sort',
            'uses' => 'App\Http\Controllers\Admin\UserTransactionController@sort',
            'middleware' => 'can:user_transactions-edit',
        ]);
    });

    Route::prefix('user-types')->group(function () {
        Route::get('/', [
            'as' => 'administrator.user_types.index',
            'uses' => 'App\Http\Controllers\Admin\UserTypeController@index',
            'middleware' => 'can:user_types-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.user_types.create',
            'uses' => 'App\Http\Controllers\Admin\UserTypeController@create',
            'middleware' => 'can:user_types-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.user_types.store',
            'uses' => 'App\Http\Controllers\Admin\UserTypeController@store',
            'middleware' => 'can:user_types-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.user_types.edit',
            'uses' => 'App\Http\Controllers\Admin\UserTypeController@edit',
            'middleware' => 'can:user_types-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.user_types.update',
            'uses' => 'App\Http\Controllers\Admin\UserTypeController@update',
            'middleware' => 'can:user_types-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.user_types.delete',
            'uses' => 'App\Http\Controllers\Admin\UserTypeController@delete',
            'middleware' => 'can:user_types-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.user_types.restore',
            'uses' => 'App\Http\Controllers\Admin\UserTypeController@restore',
            'middleware' => 'can:user_types-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.user_types.delete_many',
            'uses' => 'App\Http\Controllers\Admin\UserTypeController@deleteManyByIds',
            'middleware' => 'can:user_types-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.user_types.export',
            'uses' => 'App\Http\Controllers\Admin\UserTypeController@export',
            'middleware' => 'can:user_types-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.user_types.audit',
            'uses' => 'App\Http\Controllers\Admin\UserTypeController@audit',
            'middleware' => 'can:user_types-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.user_types.import',
            'uses' => 'App\Http\Controllers\Admin\UserTypeController@import',
            'middleware' => 'can:user_types-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.user_types.get',
            'uses' => 'App\Http\Controllers\Admin\UserTypeController@get',
            'middleware' => 'can:user_types-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.user_types.sort',
            'uses' => 'App\Http\Controllers\Admin\UserTypeController@sort',
            'middleware' => 'can:user_types-edit',
        ]);
    });

    Route::prefix('user-points')->group(function () {
        Route::get('/', [
            'as' => 'administrator.user_points.index',
            'uses' => 'App\Http\Controllers\Admin\UserPointController@index',
            'middleware' => 'can:user_points-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.user_points.create',
            'uses' => 'App\Http\Controllers\Admin\UserPointController@create',
            'middleware' => 'can:user_points-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.user_points.store',
            'uses' => 'App\Http\Controllers\Admin\UserPointController@store',
            'middleware' => 'can:user_points-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.user_points.edit',
            'uses' => 'App\Http\Controllers\Admin\UserPointController@edit',
            'middleware' => 'can:user_points-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.user_points.update',
            'uses' => 'App\Http\Controllers\Admin\UserPointController@update',
            'middleware' => 'can:user_points-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.user_points.delete',
            'uses' => 'App\Http\Controllers\Admin\UserPointController@delete',
            'middleware' => 'can:user_points-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.user_points.restore',
            'uses' => 'App\Http\Controllers\Admin\UserPointController@restore',
            'middleware' => 'can:user_points-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.user_points.delete_many',
            'uses' => 'App\Http\Controllers\Admin\UserPointController@deleteManyByIds',
            'middleware' => 'can:user_points-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.user_points.export',
            'uses' => 'App\Http\Controllers\Admin\UserPointController@export',
            'middleware' => 'can:user_points-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.user_points.audit',
            'uses' => 'App\Http\Controllers\Admin\UserPointController@audit',
            'middleware' => 'can:user_points-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.user_points.import',
            'uses' => 'App\Http\Controllers\Admin\UserPointController@import',
            'middleware' => 'can:user_points-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.user_points.get',
            'uses' => 'App\Http\Controllers\Admin\UserPointController@get',
            'middleware' => 'can:user_points-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.user_points.sort',
            'uses' => 'App\Http\Controllers\Admin\UserPointController@sort',
            'middleware' => 'can:user_points-edit',
        ]);
    });

    Route::prefix('banks')->group(function () {
        Route::get('/', [
            'as' => 'administrator.banks.index',
            'uses' => 'App\Http\Controllers\Admin\BankController@index',
            'middleware' => 'can:banks-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.banks.create',
            'uses' => 'App\Http\Controllers\Admin\BankController@create',
            'middleware' => 'can:banks-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.banks.store',
            'uses' => 'App\Http\Controllers\Admin\BankController@store',
            'middleware' => 'can:banks-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.banks.edit',
            'uses' => 'App\Http\Controllers\Admin\BankController@edit',
            'middleware' => 'can:banks-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.banks.update',
            'uses' => 'App\Http\Controllers\Admin\BankController@update',
            'middleware' => 'can:banks-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.banks.delete',
            'uses' => 'App\Http\Controllers\Admin\BankController@delete',
            'middleware' => 'can:banks-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.banks.restore',
            'uses' => 'App\Http\Controllers\Admin\BankController@restore',
            'middleware' => 'can:banks-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.banks.delete_many',
            'uses' => 'App\Http\Controllers\Admin\BankController@deleteManyByIds',
            'middleware' => 'can:banks-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.banks.export',
            'uses' => 'App\Http\Controllers\Admin\BankController@export',
            'middleware' => 'can:banks-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.banks.audit',
            'uses' => 'App\Http\Controllers\Admin\BankController@audit',
            'middleware' => 'can:banks-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.banks.import',
            'uses' => 'App\Http\Controllers\Admin\BankController@import',
            'middleware' => 'can:banks-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.banks.get',
            'uses' => 'App\Http\Controllers\Admin\BankController@get',
            'middleware' => 'can:banks-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.banks.sort',
            'uses' => 'App\Http\Controllers\Admin\BankController@sort',
            'middleware' => 'can:banks-edit',
        ]);
    });

    Route::prefix('bank-cash-ins')->group(function () {
        Route::get('/', [
            'as' => 'administrator.bank_cash_ins.index',
            'uses' => 'App\Http\Controllers\Admin\BankCashInController@index',
            'middleware' => 'can:bank_cash_ins-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.bank_cash_ins.create',
            'uses' => 'App\Http\Controllers\Admin\BankCashInController@create',
            'middleware' => 'can:bank_cash_ins-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.bank_cash_ins.store',
            'uses' => 'App\Http\Controllers\Admin\BankCashInController@store',
            'middleware' => 'can:bank_cash_ins-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.bank_cash_ins.edit',
            'uses' => 'App\Http\Controllers\Admin\BankCashInController@edit',
            'middleware' => 'can:bank_cash_ins-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.bank_cash_ins.update',
            'uses' => 'App\Http\Controllers\Admin\BankCashInController@update',
            'middleware' => 'can:bank_cash_ins-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.bank_cash_ins.delete',
            'uses' => 'App\Http\Controllers\Admin\BankCashInController@delete',
            'middleware' => 'can:bank_cash_ins-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.bank_cash_ins.restore',
            'uses' => 'App\Http\Controllers\Admin\BankCashInController@restore',
            'middleware' => 'can:bank_cash_ins-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.bank_cash_ins.delete_many',
            'uses' => 'App\Http\Controllers\Admin\BankCashInController@deleteManyByIds',
            'middleware' => 'can:bank_cash_ins-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.bank_cash_ins.export',
            'uses' => 'App\Http\Controllers\Admin\BankCashInController@export',
            'middleware' => 'can:bank_cash_ins-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.bank_cash_ins.audit',
            'uses' => 'App\Http\Controllers\Admin\BankCashInController@audit',
            'middleware' => 'can:bank_cash_ins-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.bank_cash_ins.import',
            'uses' => 'App\Http\Controllers\Admin\BankCashInController@import',
            'middleware' => 'can:bank_cash_ins-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.bank_cash_ins.get',
            'uses' => 'App\Http\Controllers\Admin\BankCashInController@get',
            'middleware' => 'can:bank_cash_ins-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.bank_cash_ins.sort',
            'uses' => 'App\Http\Controllers\Admin\BankCashInController@sort',
            'middleware' => 'can:bank_cash_ins-edit',
        ]);
    });

    Route::prefix('memberships')->group(function () {
        Route::get('/', [
            'as' => 'administrator.memberships.index',
            'uses' => 'App\Http\Controllers\Admin\MembershipController@index',
            'middleware' => 'can:memberships-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.memberships.create',
            'uses' => 'App\Http\Controllers\Admin\MembershipController@create',
            'middleware' => 'can:memberships-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.memberships.store',
            'uses' => 'App\Http\Controllers\Admin\MembershipController@store',
            'middleware' => 'can:memberships-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.memberships.edit',
            'uses' => 'App\Http\Controllers\Admin\MembershipController@edit',
            'middleware' => 'can:memberships-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.memberships.update',
            'uses' => 'App\Http\Controllers\Admin\MembershipController@update',
            'middleware' => 'can:memberships-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.memberships.delete',
            'uses' => 'App\Http\Controllers\Admin\MembershipController@delete',
            'middleware' => 'can:memberships-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.memberships.restore',
            'uses' => 'App\Http\Controllers\Admin\MembershipController@restore',
            'middleware' => 'can:memberships-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.memberships.delete_many',
            'uses' => 'App\Http\Controllers\Admin\MembershipController@deleteManyByIds',
            'middleware' => 'can:memberships-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.memberships.export',
            'uses' => 'App\Http\Controllers\Admin\MembershipController@export',
            'middleware' => 'can:memberships-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.memberships.audit',
            'uses' => 'App\Http\Controllers\Admin\MembershipController@audit',
            'middleware' => 'can:memberships-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.memberships.import',
            'uses' => 'App\Http\Controllers\Admin\MembershipController@import',
            'middleware' => 'can:memberships-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.memberships.get',
            'uses' => 'App\Http\Controllers\Admin\MembershipController@get',
            'middleware' => 'can:memberships-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.memberships.sort',
            'uses' => 'App\Http\Controllers\Admin\MembershipController@sort',
            'middleware' => 'can:memberships-edit',
        ]);
    });

    Route::prefix('shipping-methods')->group(function () {
        Route::get('/', [
            'as' => 'administrator.shipping_methods.index',
            'uses' => 'App\Http\Controllers\Admin\ShippingMethodController@index',
            'middleware' => 'can:shipping_methods-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.shipping_methods.create',
            'uses' => 'App\Http\Controllers\Admin\ShippingMethodController@create',
            'middleware' => 'can:shipping_methods-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.shipping_methods.store',
            'uses' => 'App\Http\Controllers\Admin\ShippingMethodController@store',
            'middleware' => 'can:shipping_methods-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.shipping_methods.edit',
            'uses' => 'App\Http\Controllers\Admin\ShippingMethodController@edit',
            'middleware' => 'can:shipping_methods-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.shipping_methods.update',
            'uses' => 'App\Http\Controllers\Admin\ShippingMethodController@update',
            'middleware' => 'can:shipping_methods-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.shipping_methods.delete',
            'uses' => 'App\Http\Controllers\Admin\ShippingMethodController@delete',
            'middleware' => 'can:shipping_methods-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.shipping_methods.restore',
            'uses' => 'App\Http\Controllers\Admin\ShippingMethodController@restore',
            'middleware' => 'can:shipping_methods-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.shipping_methods.delete_many',
            'uses' => 'App\Http\Controllers\Admin\ShippingMethodController@deleteManyByIds',
            'middleware' => 'can:shipping_methods-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.shipping_methods.export',
            'uses' => 'App\Http\Controllers\Admin\ShippingMethodController@export',
            'middleware' => 'can:shipping_methods-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.shipping_methods.audit',
            'uses' => 'App\Http\Controllers\Admin\ShippingMethodController@audit',
            'middleware' => 'can:shipping_methods-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.shipping_methods.import',
            'uses' => 'App\Http\Controllers\Admin\ShippingMethodController@import',
            'middleware' => 'can:shipping_methods-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.shipping_methods.get',
            'uses' => 'App\Http\Controllers\Admin\ShippingMethodController@get',
            'middleware' => 'can:shipping_methods-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.shipping_methods.sort',
            'uses' => 'App\Http\Controllers\Admin\ShippingMethodController@sort',
            'middleware' => 'can:shipping_methods-edit',
        ]);
    });

    Route::prefix('product-comments')->group(function () {
        Route::get('/', [
            'as' => 'administrator.product_comments.index',
            'uses' => 'App\Http\Controllers\Admin\ProductCommentController@index',
            'middleware' => 'can:product_comments-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.product_comments.create',
            'uses' => 'App\Http\Controllers\Admin\ProductCommentController@create',
            'middleware' => 'can:product_comments-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.product_comments.store',
            'uses' => 'App\Http\Controllers\Admin\ProductCommentController@store',
            'middleware' => 'can:product_comments-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.product_comments.edit',
            'uses' => 'App\Http\Controllers\Admin\ProductCommentController@edit',
            'middleware' => 'can:product_comments-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.product_comments.update',
            'uses' => 'App\Http\Controllers\Admin\ProductCommentController@update',
            'middleware' => 'can:product_comments-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.product_comments.delete',
            'uses' => 'App\Http\Controllers\Admin\ProductCommentController@delete',
            'middleware' => 'can:product_comments-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.product_comments.restore',
            'uses' => 'App\Http\Controllers\Admin\ProductCommentController@restore',
            'middleware' => 'can:product_comments-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.product_comments.delete_many',
            'uses' => 'App\Http\Controllers\Admin\ProductCommentController@deleteManyByIds',
            'middleware' => 'can:product_comments-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.product_comments.export',
            'uses' => 'App\Http\Controllers\Admin\ProductCommentController@export',
            'middleware' => 'can:product_comments-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.product_comments.audit',
            'uses' => 'App\Http\Controllers\Admin\ProductCommentController@audit',
            'middleware' => 'can:product_comments-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.product_comments.import',
            'uses' => 'App\Http\Controllers\Admin\ProductCommentController@import',
            'middleware' => 'can:product_comments-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.product_comments.get',
            'uses' => 'App\Http\Controllers\Admin\ProductCommentController@get',
            'middleware' => 'can:product_comments-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.product_comments.sort',
            'uses' => 'App\Http\Controllers\Admin\ProductCommentController@sort',
            'middleware' => 'can:product_comments-edit',
        ]);
    });

    Route::prefix('flash-sales')->group(function () {
        Route::get('/', [
            'as' => 'administrator.flash_sales.index',
            'uses' => 'App\Http\Controllers\Admin\FlashSaleController@index',
            'middleware' => 'can:flash_sales-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.flash_sales.create',
            'uses' => 'App\Http\Controllers\Admin\FlashSaleController@create',
            'middleware' => 'can:flash_sales-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.flash_sales.store',
            'uses' => 'App\Http\Controllers\Admin\FlashSaleController@store',
            'middleware' => 'can:flash_sales-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.flash_sales.edit',
            'uses' => 'App\Http\Controllers\Admin\FlashSaleController@edit',
            'middleware' => 'can:flash_sales-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.flash_sales.update',
            'uses' => 'App\Http\Controllers\Admin\FlashSaleController@update',
            'middleware' => 'can:flash_sales-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.flash_sales.delete',
            'uses' => 'App\Http\Controllers\Admin\FlashSaleController@delete',
            'middleware' => 'can:flash_sales-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.flash_sales.restore',
            'uses' => 'App\Http\Controllers\Admin\FlashSaleController@restore',
            'middleware' => 'can:flash_sales-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.flash_sales.delete_many',
            'uses' => 'App\Http\Controllers\Admin\FlashSaleController@deleteManyByIds',
            'middleware' => 'can:flash_sales-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.flash_sales.export',
            'uses' => 'App\Http\Controllers\Admin\FlashSaleController@export',
            'middleware' => 'can:flash_sales-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.flash_sales.audit',
            'uses' => 'App\Http\Controllers\Admin\FlashSaleController@audit',
            'middleware' => 'can:flash_sales-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.flash_sales.import',
            'uses' => 'App\Http\Controllers\Admin\FlashSaleController@import',
            'middleware' => 'can:flash_sales-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.flash_sales.get',
            'uses' => 'App\Http\Controllers\Admin\FlashSaleController@get',
            'middleware' => 'can:flash_sales-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.flash_sales.sort',
            'uses' => 'App\Http\Controllers\Admin\FlashSaleController@sort',
            'middleware' => 'can:flash_sales-edit',
        ]);
    });

    Route::prefix('register-cities')->group(function () {
        Route::get('/', [
            'as' => 'administrator.register_cities.index',
            'uses' => 'App\Http\Controllers\Admin\RegisterCityController@index',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.register_cities.create',
            'uses' => 'App\Http\Controllers\Admin\RegisterCityController@create',
            'middleware' => 'can:history_datas-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.register_cities.store',
            'uses' => 'App\Http\Controllers\Admin\RegisterCityController@store',
            'middleware' => 'can:history_datas-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.register_cities.edit',
            'uses' => 'App\Http\Controllers\Admin\RegisterCityController@edit',
            'middleware' => 'can:history_datas-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.register_cities.update',
            'uses' => 'App\Http\Controllers\Admin\RegisterCityController@update',
            'middleware' => 'can:history_datas-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.register_cities.delete',
            'uses' => 'App\Http\Controllers\Admin\RegisterCityController@delete',
            'middleware' => 'can:history_datas-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.register_cities.restore',
            'uses' => 'App\Http\Controllers\Admin\RegisterCityController@restore',
            'middleware' => 'can:register_cities-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.register_cities.delete_many',
            'uses' => 'App\Http\Controllers\Admin\RegisterCityController@deleteManyByIds',
            'middleware' => 'can:history_datas-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.register_cities.export',
            'uses' => 'App\Http\Controllers\Admin\RegisterCityController@export',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.register_cities.audit',
            'uses' => 'App\Http\Controllers\Admin\RegisterCityController@audit',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.register_cities.import',
            'uses' => 'App\Http\Controllers\Admin\RegisterCityController@import',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.register_cities.get',
            'uses' => 'App\Http\Controllers\Admin\RegisterCityController@get',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.register_cities.sort',
            'uses' => 'App\Http\Controllers\Admin\RegisterCityController@sort',
            'middleware' => 'can:history_datas-edit',
        ]);
    });

    Route::prefix('register-districts')->group(function () {
        Route::get('/', [
            'as' => 'administrator.register_districts.index',
            'uses' => 'App\Http\Controllers\Admin\RegisterDistrictController@index',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.register_districts.create',
            'uses' => 'App\Http\Controllers\Admin\RegisterDistrictController@create',
            'middleware' => 'can:history_datas-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.register_districts.store',
            'uses' => 'App\Http\Controllers\Admin\RegisterDistrictController@store',
            'middleware' => 'can:history_datas-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.register_districts.edit',
            'uses' => 'App\Http\Controllers\Admin\RegisterDistrictController@edit',
            'middleware' => 'can:history_datas-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.register_districts.update',
            'uses' => 'App\Http\Controllers\Admin\RegisterDistrictController@update',
            'middleware' => 'can:history_datas-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.register_districts.delete',
            'uses' => 'App\Http\Controllers\Admin\RegisterDistrictController@delete',
            'middleware' => 'can:history_datas-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.register_districts.restore',
            'uses' => 'App\Http\Controllers\Admin\RegisterDistrictController@restore',
            'middleware' => 'can:register_districts-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.register_districts.delete_many',
            'uses' => 'App\Http\Controllers\Admin\RegisterDistrictController@deleteManyByIds',
            'middleware' => 'can:history_datas-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.register_districts.export',
            'uses' => 'App\Http\Controllers\Admin\RegisterDistrictController@export',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.register_districts.audit',
            'uses' => 'App\Http\Controllers\Admin\RegisterDistrictController@audit',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.register_districts.import',
            'uses' => 'App\Http\Controllers\Admin\RegisterDistrictController@import',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.register_districts.get',
            'uses' => 'App\Http\Controllers\Admin\RegisterDistrictController@get',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.register_districts.sort',
            'uses' => 'App\Http\Controllers\Admin\RegisterDistrictController@sort',
            'middleware' => 'can:history_datas-edit',
        ]);
    });

    Route::prefix('register-wards')->group(function () {
        Route::get('/', [
            'as' => 'administrator.register_wards.index',
            'uses' => 'App\Http\Controllers\Admin\RegisterWardController@index',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.register_wards.create',
            'uses' => 'App\Http\Controllers\Admin\RegisterWardController@create',
            'middleware' => 'can:history_datas-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.register_wards.store',
            'uses' => 'App\Http\Controllers\Admin\RegisterWardController@store',
            'middleware' => 'can:history_datas-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.register_wards.edit',
            'uses' => 'App\Http\Controllers\Admin\RegisterWardController@edit',
            'middleware' => 'can:history_datas-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.register_wards.update',
            'uses' => 'App\Http\Controllers\Admin\RegisterWardController@update',
            'middleware' => 'can:history_datas-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.register_wards.delete',
            'uses' => 'App\Http\Controllers\Admin\RegisterWardController@delete',
            'middleware' => 'can:history_datas-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.register_wards.restore',
            'uses' => 'App\Http\Controllers\Admin\RegisterWardController@restore',
            'middleware' => 'can:register_wards-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.register_wards.delete_many',
            'uses' => 'App\Http\Controllers\Admin\RegisterWardController@deleteManyByIds',
            'middleware' => 'can:history_datas-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.register_wards.export',
            'uses' => 'App\Http\Controllers\Admin\RegisterWardController@export',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.register_wards.audit',
            'uses' => 'App\Http\Controllers\Admin\RegisterWardController@audit',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.register_wards.import',
            'uses' => 'App\Http\Controllers\Admin\RegisterWardController@import',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.register_wards.get',
            'uses' => 'App\Http\Controllers\Admin\RegisterWardController@get',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.register_wards.sort',
            'uses' => 'App\Http\Controllers\Admin\RegisterWardController@sort',
            'middleware' => 'can:history_datas-edit',
        ]);
    });

    Route::prefix('calendars')->group(function () {
        Route::get('/', [
            'as' => 'administrator.calendars.index',
            'uses' => 'App\Http\Controllers\Admin\CalendarController@index',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.calendars.create',
            'uses' => 'App\Http\Controllers\Admin\CalendarController@create',
            'middleware' => 'can:history_datas-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.calendars.store',
            'uses' => 'App\Http\Controllers\Admin\CalendarController@store',
            'middleware' => 'can:history_datas-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.calendars.edit',
            'uses' => 'App\Http\Controllers\Admin\CalendarController@edit',
            'middleware' => 'can:history_datas-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.calendars.update',
            'uses' => 'App\Http\Controllers\Admin\CalendarController@update',
            'middleware' => 'can:history_datas-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.calendars.delete',
            'uses' => 'App\Http\Controllers\Admin\CalendarController@delete',
            'middleware' => 'can:history_datas-delete',
        ]);

        Route::post('/restore/{id}', [
            'as' => 'administrator.calendars.restore',
            'uses' => 'App\Http\Controllers\Admin\CalendarController@restore',
            'middleware' => 'can:calendars-edit',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.calendars.delete_many',
            'uses' => 'App\Http\Controllers\Admin\CalendarController@deleteManyByIds',
            'middleware' => 'can:history_datas-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.calendars.export',
            'uses' => 'App\Http\Controllers\Admin\CalendarController@export',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::get('/audit/{id}', [
            'as' => 'administrator.calendars.audit',
            'uses' => 'App\Http\Controllers\Admin\CalendarController@audit',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.calendars.import',
            'uses' => 'App\Http\Controllers\Admin\CalendarController@import',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.calendars.get',
            'uses' => 'App\Http\Controllers\Admin\CalendarController@get',
            'middleware' => 'can:history_datas-list',
        ]);

        Route::put('/sort', [
            'as' => 'administrator.calendars.sort',
            'uses' => 'App\Http\Controllers\Admin\CalendarController@sort',
            'middleware' => 'can:history_datas-edit',
        ]);
    });

    Route::prefix('f_a_q_s')->group(function () {
        Route::get('/', ['as' => 'administrator.f_a_q_s.index', 'uses' => 'App\Http\Controllers\Admin\FAQController@index', 'middleware' => 'can:f_a_q_s-list',]);
        Route::get('/create', ['as' => 'administrator.f_a_q_s.create', 'uses' => 'App\Http\Controllers\Admin\FAQController@create', 'middleware' => 'can:f_a_q_s-add',]);
        Route::post('/store', ['as' => 'administrator.f_a_q_s.store', 'uses' => 'App\Http\Controllers\Admin\FAQController@store', 'middleware' => 'can:f_a_q_s-add',]);
        Route::get('/edit/{id}', ['as' => 'administrator.f_a_q_s.edit', 'uses' => 'App\Http\Controllers\Admin\FAQController@edit', 'middleware' => 'can:f_a_q_s-edit',]);
        Route::put('/update/{id}', ['as' => 'administrator.f_a_q_s.update', 'uses' => 'App\Http\Controllers\Admin\FAQController@update', 'middleware' => 'can:f_a_q_s-edit',]);
        Route::delete('/delete/{id}', ['as' => 'administrator.f_a_q_s.delete', 'uses' => 'App\Http\Controllers\Admin\FAQController@delete', 'middleware' => 'can:f_a_q_s-delete',]);
        Route::post('/restore/{id}', [
            'as' => 'administrator.f_a_q_s.restore',
            'uses' => 'App\Http\Controllers\Admin\FAQController@restore',
            'middleware' => 'can:f_a_q_s-edit',
        ]);
        Route::delete('/delete-many', ['as' => 'administrator.f_a_q_s.delete_many', 'uses' => 'App\Http\Controllers\Admin\FAQController@deleteManyByIds', 'middleware' => 'can:f_a_q_s-delete',]);
        Route::get('/export', ['as' => 'administrator.f_a_q_s.export', 'uses' => 'App\Http\Controllers\Admin\FAQController@export', 'middleware' => 'can:f_a_q_s-list',]);
        Route::get('/audit/{id}', ['as' => 'administrator.f_a_q_s.audit', 'uses' => 'App\Http\Controllers\Admin\FAQController@audit', 'middleware' => 'can:f_a_q_s-list',]);
        Route::get('/import', ['as' => 'administrator.f_a_q_s.import', 'uses' => 'App\Http\Controllers\Admin\FAQController@import', 'middleware' => 'can:f_a_q_s-list',]);
        Route::get('/{id}', ['as' => 'administrator.f_a_q_s.get', 'uses' => 'App\Http\Controllers\Admin\FAQController@get', 'middleware' => 'can:f_a_q_s-list',]);
        Route::put('/', ['as' => 'administrator.f_a_q_s.sort', 'uses' => 'App\Http\Controllers\Admin\FAQController@sort', 'middleware' => 'can:f_a_q_s-edit',]);
    });

    Route::prefix('affiliates')->group(function () {
        Route::get('/', ['as' => 'administrator.affiliates.index', 'uses' => 'App\Http\Controllers\Admin\AffiliateController@index', 'middleware' => 'can:f_a_q_s-list',]);
    });

    Route::prefix('posts')->group(function () {
        Route::get('/', ['as'=>'administrator.posts.index','uses'=>'App\Http\Controllers\Admin\PostController@index','middleware'=>'can:posts-list',]);
        Route::get('/create', ['as'=>'administrator.posts.create','uses'=>'App\Http\Controllers\Admin\PostController@create','middleware'=>'can:posts-add',]);
        Route::post('/store', ['as'=>'administrator.posts.store','uses'=>'App\Http\Controllers\Admin\PostController@store','middleware'=>'can:posts-add',]);
        Route::get('/edit/{id}', ['as'=>'administrator.posts.edit','uses'=>'App\Http\Controllers\Admin\PostController@edit','middleware'=>'can:posts-edit',]);
        Route::put('/update/{id}', ['as'=>'administrator.posts.update','uses'=>'App\Http\Controllers\Admin\PostController@update','middleware'=>'can:posts-edit',]);
        Route::delete('/delete/{id}', ['as'=>'administrator.posts.delete','uses'=>'App\Http\Controllers\Admin\PostController@delete','middleware'=>'can:posts-delete',]);
        Route::delete('/delete-many', ['as'=>'administrator.posts.delete_many','uses'=>'App\Http\Controllers\Admin\PostController@deleteManyByIds','middleware'=>'can:posts-delete',]);
        Route::post('/restore/{id}', ['as' => 'administrator.posts.restore','uses' => 'App\Http\Controllers\Admin\PostController@restore','middleware' => 'can:posts-edit',]);
        Route::get('/export', ['as'=>'administrator.posts.export','uses'=>'App\Http\Controllers\Admin\PostController@export','middleware'=>'can:posts-list',]);
        Route::get('/audit/{id}', ['as'=>'administrator.posts.audit','uses'=>'App\Http\Controllers\Admin\PostController@audit','middleware'=>'can:posts-list',]);
        Route::get('/import', ['as'=>'administrator.posts.import','uses'=>'App\Http\Controllers\Admin\PostController@import','middleware'=>'can:posts-list',]);
        Route::get('/{id}', ['as'=>'administrator.posts.get','uses'=>'App\Http\Controllers\Admin\PostController@get','middleware'=>'can:posts-list',]);
        Route::put('/', ['as'=>'administrator.posts.sort','uses'=>'App\Http\Controllers\Admin\PostController@sort','middleware'=>'can:posts-edit',]);
    });
    Route::prefix('post_comments')->group(function () {
        Route::get('/', ['as'=>'administrator.post_comments.index','uses'=>'App\Http\Controllers\Admin\PostCommentController@index','middleware'=>'can:post_comments-list',]);
        Route::get('/create', ['as'=>'administrator.post_comments.create','uses'=>'App\Http\Controllers\Admin\PostCommentController@create','middleware'=>'can:post_comments-add',]);
        Route::post('/store', ['as'=>'administrator.post_comments.store','uses'=>'App\Http\Controllers\Admin\PostCommentController@store','middleware'=>'can:post_comments-add',]);
        Route::get('/edit/{id}', ['as'=>'administrator.post_comments.edit','uses'=>'App\Http\Controllers\Admin\PostCommentController@edit','middleware'=>'can:post_comments-edit',]);
        Route::put('/update/{id}', ['as'=>'administrator.post_comments.update','uses'=>'App\Http\Controllers\Admin\PostCommentController@update','middleware'=>'can:post_comments-edit',]);
        Route::delete('/delete/{id}', ['as'=>'administrator.post_comments.delete','uses'=>'App\Http\Controllers\Admin\PostCommentController@delete','middleware'=>'can:post_comments-delete',]);
        Route::delete('/delete-many', ['as'=>'administrator.post_comments.delete_many','uses'=>'App\Http\Controllers\Admin\PostCommentController@deleteManyByIds','middleware'=>'can:post_comments-delete',]);
        Route::post('/restore/{id}', ['as' => 'administrator.post_comments.restore','uses' => 'App\Http\Controllers\Admin\PostCommentController@restore','middleware' => 'can:post_comments-edit',]);
        Route::get('/export', ['as'=>'administrator.post_comments.export','uses'=>'App\Http\Controllers\Admin\PostCommentController@export','middleware'=>'can:post_comments-list',]);
        Route::get('/audit/{id}', ['as'=>'administrator.post_comments.audit','uses'=>'App\Http\Controllers\Admin\PostCommentController@audit','middleware'=>'can:post_comments-list',]);
        Route::get('/import', ['as'=>'administrator.post_comments.import','uses'=>'App\Http\Controllers\Admin\PostCommentController@import','middleware'=>'can:post_comments-list',]);
        Route::get('/{id}', ['as'=>'administrator.post_comments.get','uses'=>'App\Http\Controllers\Admin\PostCommentController@get','middleware'=>'can:post_comments-list',]);
        Route::put('/', ['as'=>'administrator.post_comments.sort','uses'=>'App\Http\Controllers\Admin\PostCommentController@sort','middleware'=>'can:post_comments-edit',]);
    });
    Route::prefix('reason_cancels')->group(function () {
        Route::get('/', ['as'=>'administrator.reason_cancels.index','uses'=>'App\Http\Controllers\Admin\ReasonCancelController@index','middleware'=>'can:reason_cancels-list',]);
        Route::get('/create', ['as'=>'administrator.reason_cancels.create','uses'=>'App\Http\Controllers\Admin\ReasonCancelController@create','middleware'=>'can:reason_cancels-add',]);
        Route::post('/store', ['as'=>'administrator.reason_cancels.store','uses'=>'App\Http\Controllers\Admin\ReasonCancelController@store','middleware'=>'can:reason_cancels-add',]);
        Route::get('/edit/{id}', ['as'=>'administrator.reason_cancels.edit','uses'=>'App\Http\Controllers\Admin\ReasonCancelController@edit','middleware'=>'can:reason_cancels-edit',]);
        Route::put('/update/{id}', ['as'=>'administrator.reason_cancels.update','uses'=>'App\Http\Controllers\Admin\ReasonCancelController@update','middleware'=>'can:reason_cancels-edit',]);
        Route::delete('/delete/{id}', ['as'=>'administrator.reason_cancels.delete','uses'=>'App\Http\Controllers\Admin\ReasonCancelController@delete','middleware'=>'can:reason_cancels-delete',]);
        Route::delete('/delete-many', ['as'=>'administrator.reason_cancels.delete_many','uses'=>'App\Http\Controllers\Admin\ReasonCancelController@deleteManyByIds','middleware'=>'can:reason_cancels-delete',]);
        Route::post('/restore/{id}', ['as' => 'administrator.reason_cancels.restore','uses' => 'App\Http\Controllers\Admin\ReasonCancelController@restore','middleware' => 'can:reason_cancels-edit',]);
        Route::get('/export', ['as'=>'administrator.reason_cancels.export','uses'=>'App\Http\Controllers\Admin\ReasonCancelController@export','middleware'=>'can:reason_cancels-list',]);
        Route::get('/audit/{id}', ['as'=>'administrator.reason_cancels.audit','uses'=>'App\Http\Controllers\Admin\ReasonCancelController@audit','middleware'=>'can:reason_cancels-list',]);
        Route::get('/import', ['as'=>'administrator.reason_cancels.import','uses'=>'App\Http\Controllers\Admin\ReasonCancelController@import','middleware'=>'can:reason_cancels-list',]);
        Route::get('/{id}', ['as'=>'administrator.reason_cancels.get','uses'=>'App\Http\Controllers\Admin\ReasonCancelController@get','middleware'=>'can:reason_cancels-list',]);
        Route::put('/', ['as'=>'administrator.reason_cancels.sort','uses'=>'App\Http\Controllers\Admin\ReasonCancelController@sort','middleware'=>'can:reason_cancels-edit',]);
    });
    Route::prefix('app_versions')->group(function () {
        Route::get('/', ['as'=>'administrator.app_versions.index','uses'=>'App\Http\Controllers\Admin\AppVersionController@index','middleware'=>'can:app_versions-list',]);
        Route::get('/create', ['as'=>'administrator.app_versions.create','uses'=>'App\Http\Controllers\Admin\AppVersionController@create','middleware'=>'can:app_versions-add',]);
        Route::post('/store', ['as'=>'administrator.app_versions.store','uses'=>'App\Http\Controllers\Admin\AppVersionController@store','middleware'=>'can:app_versions-add',]);
        Route::get('/edit/{id}', ['as'=>'administrator.app_versions.edit','uses'=>'App\Http\Controllers\Admin\AppVersionController@edit','middleware'=>'can:app_versions-edit',]);
        Route::put('/update/{id}', ['as'=>'administrator.app_versions.update','uses'=>'App\Http\Controllers\Admin\AppVersionController@update','middleware'=>'can:app_versions-edit',]);
        Route::delete('/delete/{id}', ['as'=>'administrator.app_versions.delete','uses'=>'App\Http\Controllers\Admin\AppVersionController@delete','middleware'=>'can:app_versions-delete',]);
        Route::delete('/delete-many', ['as'=>'administrator.app_versions.delete_many','uses'=>'App\Http\Controllers\Admin\AppVersionController@deleteManyByIds','middleware'=>'can:app_versions-delete',]);
        Route::post('/restore/{id}', ['as' => 'administrator.app_versions.restore','uses' => 'App\Http\Controllers\Admin\AppVersionController@restore','middleware' => 'can:app_versions-edit',]);
        Route::get('/export', ['as'=>'administrator.app_versions.export','uses'=>'App\Http\Controllers\Admin\AppVersionController@export','middleware'=>'can:app_versions-list',]);
        Route::get('/audit/{id}', ['as'=>'administrator.app_versions.audit','uses'=>'App\Http\Controllers\Admin\AppVersionController@audit','middleware'=>'can:app_versions-list',]);
        Route::get('/import', ['as'=>'administrator.app_versions.import','uses'=>'App\Http\Controllers\Admin\AppVersionController@import','middleware'=>'can:app_versions-list',]);
        Route::get('/{id}', ['as'=>'administrator.app_versions.get','uses'=>'App\Http\Controllers\Admin\AppVersionController@get','middleware'=>'can:app_versions-list',]);
        Route::put('/', ['as'=>'administrator.app_versions.sort','uses'=>'App\Http\Controllers\Admin\AppVersionController@sort','middleware'=>'can:app_versions-edit',]);
    });
    Route::prefix('user_withdraws')->group(function () {
        Route::get('/', ['as'=>'administrator.user_withdraws.index','uses'=>'App\Http\Controllers\Admin\UserWithdrawController@index','middleware'=>'can:user_withdraws-list',]);
        Route::get('/create', ['as'=>'administrator.user_withdraws.create','uses'=>'App\Http\Controllers\Admin\UserWithdrawController@create','middleware'=>'can:user_withdraws-add',]);
        Route::post('/store', ['as'=>'administrator.user_withdraws.store','uses'=>'App\Http\Controllers\Admin\UserWithdrawController@store','middleware'=>'can:user_withdraws-add',]);
        Route::get('/edit/{id}', ['as'=>'administrator.user_withdraws.edit','uses'=>'App\Http\Controllers\Admin\UserWithdrawController@edit','middleware'=>'can:user_withdraws-edit',]);
        Route::put('/update/{id}', ['as'=>'administrator.user_withdraws.update','uses'=>'App\Http\Controllers\Admin\UserWithdrawController@update','middleware'=>'can:user_withdraws-edit',]);
        Route::delete('/delete/{id}', ['as'=>'administrator.user_withdraws.delete','uses'=>'App\Http\Controllers\Admin\UserWithdrawController@delete','middleware'=>'can:user_withdraws-delete',]);
        Route::delete('/delete-many', ['as'=>'administrator.user_withdraws.delete_many','uses'=>'App\Http\Controllers\Admin\UserWithdrawController@deleteManyByIds','middleware'=>'can:user_withdraws-delete',]);
        Route::post('/restore/{id}', ['as' => 'administrator.user_withdraws.restore','uses' => 'App\Http\Controllers\Admin\UserWithdrawController@restore','middleware' => 'can:user_withdraws-edit',]);
        Route::get('/export', ['as'=>'administrator.user_withdraws.export','uses'=>'App\Http\Controllers\Admin\UserWithdrawController@export','middleware'=>'can:user_withdraws-list',]);
        Route::get('/audit/{id}', ['as'=>'administrator.user_withdraws.audit','uses'=>'App\Http\Controllers\Admin\UserWithdrawController@audit','middleware'=>'can:user_withdraws-list',]);
        Route::get('/import', ['as'=>'administrator.user_withdraws.import','uses'=>'App\Http\Controllers\Admin\UserWithdrawController@import','middleware'=>'can:user_withdraws-list',]);
        Route::get('/{id}', ['as'=>'administrator.user_withdraws.get','uses'=>'App\Http\Controllers\Admin\UserWithdrawController@get','middleware'=>'can:user_withdraws-list',]);
        Route::put('/', ['as'=>'administrator.user_withdraws.sort','uses'=>'App\Http\Controllers\Admin\UserWithdrawController@sort','middleware'=>'can:user_withdraws-edit',]);
    });/*step_1*/
});
