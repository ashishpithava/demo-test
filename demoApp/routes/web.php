<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/blogs', function () {
    return view('home');
});

Route::get('/{blog}', function ($slug) {

    $path = __DIR__ . "/../resources/blogs/{$slug}.html";
    if (!file_exists($path)) {
        return redirect('/');
    }
    $blog = cache()->remember("blogs.{$slug}", 1200, fn() => file_get_contents($path));

    return view('home', ['blog' => $blog]);
})->where('blog', '[A-z0-9_\-]+');
