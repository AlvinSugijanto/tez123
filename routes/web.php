<?php
namespace App\Http\Controllers;
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


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

Route::get('/', [AuthController::class, 'login_page']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);


Route::get('pegawai', [PegawaiController::class, 'indexPegawai']);
Route::post('pegawai/create', [PegawaiController::class, 'create']);
Route::post('pegawai/edit', [PegawaiController::class, 'edit']);
Route::post('pegawai/update', [PegawaiController::class, 'update']);



Route::get('advanced-menu', [MenuController::class, 'getMenu']);
Route::get('menu', [MenuController::class, 'index']);
Route::get('menu/create', [MenuController::class, 'create']);
Route::post('menu/store', [MenuController::class, 'store']);
Route::post('menu/edit', [MenuController::class, 'edit']);
Route::post('menu/delete/{id}', [MenuController::class, 'delete']);
Route::post('deleteDM', [MenuController::class, 'deleteDM']);
Route::post('deleteHarga', [MenuController::class, 'deleteHarga']);



Route::get('ingredients', [IngredientsController::class, 'index']);
Route::post('ingredients/store', [IngredientsController::class, 'store']);
Route::post('ingredients/edit', [IngredientsController::class, 'edit']);
Route::post('ingredients/delete/{id}', [IngredientsController::class, 'delete']);



Route::get('ingredients_purchase', [PurchaseController::class, 'index']);
Route::post('purchase/create', [PurchaseController::class, 'create']);
Route::post('purchase/show', [PurchaseController::class, 'show']);




Route::get('kategori', [KategoriController::class, 'index']);



Route::get('order', [OrderController::class, 'index']);
Route::get('create_order', [OrderController::class, 'create_order']);
Route::post('order/store', [OrderController::class, 'store']);
Route::post('order/show', [OrderController::class, 'show']);
Route::post('order/getDetail', [OrderController::class, 'getDetailOrder']);
Route::get('editOrder/{id}', [OrderController::class, 'editOrder']);
Route::post('order/storeEdit', [OrderController::class, 'editStore']);


Route::post('getHarga', [OrderController::class, 'getHarga']);



Route::get('ongoing-order', [OngoingOrderController::class, 'index']);



Route::get('overall-report', [ReportController::class, 'overall_report']);
Route::post('get_overall_report', [ReportController::class, 'get_overall_report']);

Route::get('by_menu', [ReportController::class, 'by_menu']);
Route::post('get_by_menu', [ReportController::class, 'get_by_menu']);

Route::get('stok_report', [ReportController::class, 'stok_report']);
Route::post('get_stok_report', [ReportController::class, 'get_stok_report']);

Route::get('detail_hpp', [ReportController::class, 'detail_hpp']);
Route::post('get_detail_hpp', [ReportController::class, 'get_detail_hpp']);


