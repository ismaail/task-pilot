<?php

use App\Livewire\BoardComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('boards/{board}', BoardComponent::class)->name('boards.show');
