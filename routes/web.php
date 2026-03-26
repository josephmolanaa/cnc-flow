<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuotationPdfController;
use App\Http\Controllers\QuotationApprovalController;

Route::get('/', function () {
    return view('welcome');
});

// Route PDF Quotation
Route::middleware(['auth'])->group(function () {
    Route::get('/quotation/{quotation}/pdf', [QuotationPdfController::class, 'download'])
         ->name('quotation.pdf');
});

// Route Approval (tanpa login)
Route::get('/quotation/approve/{token}', [QuotationApprovalController::class, 'approve'])
     ->name('quotation.approve');