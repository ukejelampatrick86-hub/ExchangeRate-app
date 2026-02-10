<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Currency;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // 🔹 Total transactions du jour
        $totalTransactions = Transaction::whereDate('transaction_date', $today)->count();

        // 🔹 Montant total échangé du jour (en devise apportée)
        $totalAmount = Transaction::whereDate('transaction_date', $today)->sum('amount_from');

        // 🔹 Transactions par devise reçue
        $transactionsByCurrency = Transaction::select('currency_to')
            ->selectRaw('SUM(amount_to) as total_received')
            ->whereDate('transaction_date', $today)
            ->groupBy('currency_to')
            ->with('currencyTo')
            ->get();

        // 🔹 Caissier le plus actif du jour
        $topCashier = Transaction::select('user_id')
            ->selectRaw('COUNT(*) as total_transactions')
            ->whereDate('transaction_date', $today)
            ->groupBy('user_id')
            ->with('user')
            ->orderByDesc('total_transactions')
            ->first();

        return view('admin.dashboard', compact(
            'totalTransactions',
            'totalAmount',
            'transactionsByCurrency',
            'topCashier'
        ));
    }
}
