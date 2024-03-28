<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'sections'], function () {
    Route::get('header', [SectionController::class, 'getHeader']);
    Route::get('footer', [SectionController::class, 'getFooter']);
});
Route::get('index', [PageController::class, 'indexPage']);
Route::get('history', [PageController::class, 'companyHistory']);
Route::get('requisites', [PageController::class, 'requisitesPage']);
Route::get('articles', [PageController::class, 'companyArticles']);
Route::get('requirements', [PageController::class, 'requirementsPage']);
Route::get('products/{slug}', [PageController::class, 'productPage']);
