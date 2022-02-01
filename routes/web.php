<?php

use App\Http\Controllers\TicketController;
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

Route::get('/', [TicketController::class, 'login'])->name('login');
Route::get('/registro', [TicketController::class, 'register'])->name('register');
Route::post('/login/do', [TicketController::class, 'postLogin'])->name('postLogin');
Route::post('/registro/do', [TicketController::class, 'postRegister'])->name('postRegister');
Route::get('/criar-ticket', [TicketController::class, 'showFormTicket'])->middleware('auth');
Route::post('/criar-ticket/do', [TicketController::class, 'postTicket'])->name('postTicket');
