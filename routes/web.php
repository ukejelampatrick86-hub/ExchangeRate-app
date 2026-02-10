<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionsExport;
use App\Http\Controllers\AdminDashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('transactions.index');
});

/**
 * Transactions (CRUD)
 */
Route::resource('transactions', TransactionController::class);

/**
 * Admin (protégé par middleware role:admin)
 */
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.dashboard');
});

// Routes pour les transactions protégées par auth
Route::middleware(['auth'])->group(function () {

    // Formulaire de création
    Route::get('/transactions/create', [TransactionController::class, 'create'])
        ->name('transactions.create');

    // Enregistrer la transaction
    Route::post('/transactions', [TransactionController::class, 'store'])
        ->name('transactions.store');

    // Lister toutes les transactions
    Route::get('/transactions', [TransactionController::class, 'index'])
        ->name('transactions.index');

    // Télécharger le reçu PDF d'une transaction
Route::get('/transactions/{transaction}/receipt', [TransactionController::class, 'receipt'])
    ->middleware('auth')
    ->name('transactions.receipt');

});

Route::middleware(['auth', 'role:admin'])->group(function() {

    // Export journalière
    Route::get('/transactions/export/daily', function () {
        return Excel::download(new TransactionsExport('daily'), 'transactions_journalieres.xlsx');
    })->name('transactions.export.daily');

    // Export mensuelle
    Route::get('/transactions/export/monthly', function () {
        return Excel::download(new TransactionsExport('monthly'), 'transactions_mensuelles.xlsx');
    })->name('transactions.export.monthly');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
});

Route::get('lang/{locale}', function ($locale) {
    // Vérifier que la langue est supportée
    $availableLocales = ['fr', 'en'];
    if (in_array($locale, $availableLocales)) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('setlocale');

