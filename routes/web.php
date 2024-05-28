<?php

use App\Livewire\LifeCycle;
use Illuminate\Support\Facades\Route;

Route::get('/', LifeCycle::class)->name('page.lifecycle');
Route::get('/mount/{uuidOrTitle}', LifeCycle::class)->name('page.uuid');
Route::get('/post/{uuidOrTitle}/{caption}', LifeCycle::class)->name('page.post');
