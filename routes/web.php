<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Farmer\DashboardController as FarmerDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EquipmentController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Farmer\AnnounceController;
use App\Http\Controllers\Farmer\BorrowedEquipmentController as FarmerBorrowedEquipmentController;
use App\Http\Controllers\Admin\BorrowedEquipmentController as AdminBorrowedEquipmentController;
use App\Http\Controllers\Admin\SalesReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('admin/categories', CategoryController::class)->names([
        'index' => 'categories.index',
        'create' => 'categories.create',
        'store' => 'categories.store',
        'show' => 'categories.show',
        'edit' => 'categories.edit',
        'update' => 'categories.update',
        'destroy' => 'categories.destroy',
    ]);
    Route::resource('admin/equipment', EquipmentController::class)->names([
        'index' => 'equipment.index',
        'create' => 'equipment.create',
        'store' => 'equipment.store',
        'show' => 'equipment.show',
        'edit' => 'equipment.edit',
        'update' => 'equipment.update',
        'destroy' => 'equipment.destroy',
    ]);
    Route::resource('admin/announcements', AnnouncementController::class)->names([
        'index' => 'announcements.index',
        'create' => 'announcements.create',
        'store' => 'announcements.store',
        'show' => 'announcements.show',
        'edit' => 'announcements.edit',
        'update' => 'announcements.update',
        'destroy' => 'announcements.destroy',
    ]);
    Route::resource('admin/borrowed-equipment', AdminBorrowedEquipmentController::class)->names([
        'index' => 'borrowed_equipment.index',
        'update' => 'borrowed_equipment.update',
    ]);
    Route::get('/admin/sales-report', [SalesReportController::class, 'index'])->name('sales_report.index');


});



Route::middleware(['auth'])->group(function () {
    Route::get('/farmer/dashboard', [FarmerDashboardController::class, 'index'])->name('farmer.dashboard');
    Route::get('/farmer/services', [FarmerDashboardController::class, 'services'])->name('farmer.services');
    Route::get('/farmer/announcements', [AnnounceController::class, 'index'])->name('farmer.announcements.index');
    Route::get('/farmer/announcements/{announcement}', [AnnounceController::class, 'show'])->name('farmer.announcements.show');
    Route::resource('farmer/borrowed-equipment', FarmerBorrowedEquipmentController::class)->names([
        'index' => 'farmer.borrowed_equipment.index',
        'create' => 'farmer.borrowed_equipment.create',
        'store' => 'farmer.borrowed_equipment.store',
        'destroy' => 'farmer.borrowed_equipment.destroy',
    ])
        ->except(['show']);
    Route::get('farmer/borrowed-equipment/history', [FarmerBorrowedEquipmentController::class, 'history'])->name('farmer.borrowed_equipment.history');
    Route::delete('farmer/borrowed-equipment/{borrowedEquipment}/history', [FarmerBorrowedEquipmentController::class, 'destroyHistory'])->name('farmer.borrowed_equipment.destroyHistory');


});