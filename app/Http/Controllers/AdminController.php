<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'transactions_count' => Transaction::count(),
            'users_count' => User::count(),
            'latest_transactions' => Transaction::latest()->limit(5)->get(),
        ]);
    }
}
