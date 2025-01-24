<?php


use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TransaksiController;
use \App\Http\Controllers\DompetController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\ProfilController;

// Route untuk login
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::get('home', [DashboardController::class, 'index'])->name('home')->middleware('auth');
Route::post('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

// Route untuk register
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');


//// Route untuk transaksi
// transaksis/search kudu ditaro heula biar ga bentrok sama /transaksis
Route::get('/transaksis/search', [TransaksiController::class, 'search'])->name('transaksis.search');
// untuk link ke transaksi dari yg di dashboard
Route::get('/transaksis/index', [TransaksiController::class, 'index'])->name('index');
//route resource untuk transaksis
Route::resource('/transaksis', TransaksiController::class);

//// Route untuk dompet
// //route resource untuk dompets
Route::resource('/dompets', DompetController::class);

//// Route untuk budget
// budget.updexpense()
Route::get('/budgets/updexpense', [TransaksiController::class, 'updexpense'])->name('budgets.updexpense');
// untuk link ke budget dari yg di dashboard
Route::get('/budgets/index', [BudgetController::class, 'index'])->name('index');
// route resources untuk budget
Route::resource('/budgets', BudgetController::class);

//// Route untuk profil
// //route resource untuk profil
Route::resource('/profiles', ProfilController::class);

// Route utk search members
Route::get('/admins/search', [DashboardAdminController::class, 'search'])->name('admins.search');
// //route resource untuk dashboard admin
Route::resource('/admins', DashboardAdminController::class);