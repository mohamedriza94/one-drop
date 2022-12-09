<?php
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('visitor.home');
});
Auth::routes();


