<?php

use App\Http\Controllers\AdminController;
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


Route::get('/admin', [AdminController::class, 'login']);
Route::post('/admin/do', [AdminController::class, 'postLogin']);
Route::get('/admin/tickets', [AdminController::class, 'showTickets']);
Route::get('/admin/ticket/{id}/accept', [AdminController::class, 'supportAcceptTicket']);
Route::get('/admin/meus-tickets', [AdminController::class, 'showMyTickets']);
Route::get('/admin/ticket/{id}/see', [AdminController::class, 'seeTicket']);
Route::post('/admin/ticket/{id}/see', [AdminController::class, 'postResponseTicket'])->name('responseTicketCustomer');
