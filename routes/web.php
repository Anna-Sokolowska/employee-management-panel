<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(EmployeeController::class)->group(function () {
    Route::get('/employees', 'index')->name('employees.index');
    Route::get('/employees/create', 'create')->name('employees.create');
    Route::post('/employees', 'store')->name('employees.store');
    Route::get('/employees/{id}', 'show')->name('employees.show');
    Route::get('/employees/{id}/edit', 'edit')->name('employees.edit');
    Route::put('/employees/{id}', 'update')->name('employees.update');
    Route::delete('/employees/{id}', 'destroy')->name('employees.destroy');
});
