<?php

use App\Models\RegisterCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

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

Route::get('/assets/{type}/{user_id}/{id}/{size}/{slug}', [
    'uses' => 'App\Http\Controllers\ImagesController@show',
]);

Route::prefix('/demo')->group(function () {
    Route::get('/', function (Request $request) {
    });
});

Route::prefix('/news')->group(function () {
    Route::get('/{id}', [
        'as' => 'news.detail',
        'uses' => 'App\Http\Controllers\NewsController@detail',
    ]);
});

Route::get('/web/robots.txt', function () {
    $robots = new \Mguinea\Robots\Robots;

    // If on the live server
    if (env('APP_ENV') == 'production') {
        $robots->addUserAgent('*')->addSitemap('sitemap.xml');
    } else {
        // If you're on any other server, tell everyone to go away.
        $robots->addDisallow("/");
    }

    return response($robots->generate(), 200)->header('Content-Type', 'text/plain');
});
