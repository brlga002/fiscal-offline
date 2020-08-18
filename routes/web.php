<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Home@index')->name('home.index');
Route::get('/professional/{professional}', 'Home@show')->name('professional.show');
Route::get('/enviar/arquivo/professionais', 'Home@professionalFile')->name('professional.file');
Route::post('/enviar/arquivo/professionais', 'Home@professionalFileUpdate')->name('professional.fileUpdate');
Route::get('/enviar/arquivo/debitos', 'Home@debitoFile')->name('debito.file');
Route::post('/enviar/arquivo/debitos', 'Home@debitFileUpdate')->name('debito.fileUpdate');
