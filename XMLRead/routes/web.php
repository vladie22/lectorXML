<?php

use App\Http\Livewire\LoginRegister;
use App\Http\Livewire\ReadXmlData;
use App\Http\Livewire\ShowData;
use App\Http\Livewire\ShowQuantity;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/',ReadXmlData::class)->middleware('auth')->name('readXmlData');
Route::get('/tabla',ShowData::class)->middleware('auth')->name('showData');
Route::get('/tabla-kilogramos',ShowQuantity::class)->middleware('auth')->name('showQuantity');
Route::get('/login',LoginRegister::class)->name('login');
