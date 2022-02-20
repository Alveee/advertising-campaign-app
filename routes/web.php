<?php

use App\Http\Controllers\Frontend\CampaignController;
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

Route::group(['namespace' => 'Frontend', 'prefix' => 'campaigns'], function () {
    Route::get('/', [CampaignController::class, 'index'])->name('campaigns.list');
    Route::get('/create', [CampaignController::class, 'create'])->name('campaigns.create');
    Route::get('/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaigns.edit');
});
