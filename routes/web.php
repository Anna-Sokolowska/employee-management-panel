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
    Route::get('/employees/{employee}', 'show')->name('employees.show');
    Route::get('/employees/{employee}/edit', 'edit')->name('employees.edit');
    Route::put('/employees/{employee}', 'update')->name('employees.update');
    Route::delete('/employees/{employee}', 'destroy')->name('employees.destroy');
});
