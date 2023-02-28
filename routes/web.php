<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Events\Test;
use Carbon\Carbon;
use Spatie\WelcomeNotification\WelcomesNewUsers;
use App\Http\Controllers\api\v1\WelcomeController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/broadcast', function () {
    broadcast(new Test());
  });

  Route::get('/home', 'HomeController@index')->name('home');

  Route::group(['middleware' => ['web', WelcomesNewUsers::class,]], function () {
      Route::get('welcome/{user}', [WelcomeController::class, 'showWelcomeForm'])->name('welcome');
      Route::post('welcome/{user}', [WelcomeController::class, 'savePassword']);
  });

  Route::get('/pdftest',  function () {
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML('<h1>Test</h1>');
    return $pdf->download();
});