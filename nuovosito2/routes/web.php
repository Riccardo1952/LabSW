<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\SitoController;


/* in ->name('....'), .... è il nome della route. Deve essere usato per es. in  return redirect()->route('....') */
Route::get('/', [AuthController::class, 'index']);
Route::post('/authenticate', [AuthController::class, 'authenticate']);
Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom');
Route::get('login', [AuthController::class, 'login']);
Route::get('/content0',[SitoController::class,'show0']);
Route::get('/content1',[SitoController::class,'show1']);
Route::get('/content3',[SitoController::class,'show3']);
Route::get('/content4',[SitoController::class,'show4']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('messaggis', SitoController::class); /* messaggis è il nome della tabella */
Route::get('show4',[SitoController::class,'show4'])->name('show4');
Route::get('/sendMail',[SitoController::class,'sendMail'])->name('sendMail');
Route::post('emailSend',[SitoController::class,'emailSend'])->name('emailSend');

Route::get('generate-pdf', [PDFController::class, 'generatePDF'])->name('generatepdf');
Route::get('generate-pdf2', [PDFController::class, 'generatePDF2'])->name('generatepdf2');
Route::get('generate-pdf3', [PDFController::class, 'generatePDF3'])->name('generatepdf3');

