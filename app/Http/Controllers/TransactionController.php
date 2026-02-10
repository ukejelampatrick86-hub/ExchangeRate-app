<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
    // 🔹 Afficher toutes les transactions avec les relations
        $transactions = Transaction::with(['user', 'currencyFrom', 'currencyTo'])
            ->orderBy('transaction_date', 'desc')
            ->get();

        return view('transactions.index', compact('transactions'));
    }


    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'amount_from' => 'required|numeric',
        'currency_from' => 'required|string|max:3',
        'rate' => 'required|numeric',
        'currency_to' => 'required|string|max:3',
    ]);

    $amount_to = $request->amount_from * $request->rate;

    // Générer une référence unique
    $reference = 'TX-' . strtoupper(uniqid());

    $transaction = Transaction::create([
        'amount_from' => $request->amount_from,
        'currency_from' => strtoupper($request->currency_from),
        'rate' => $request->rate,
        'currency_to' => strtoupper($request->currency_to),
        'amount_to' => $amount_to,
        'reference' => $reference,
    ]);

    // Rediriger avec message de succès localisé
    return redirect()->back()->with(
        'success',
        __('app.transaction_success', ['reference' => $transaction->reference])
      );
    }


    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'amount_from' => 'required|numeric',
            'rate' => 'required|numeric',
        ]);

        $transaction->update([
            'amount_from' => $request->amount_from,
            'rate' => $request->rate,
            'amount_to' => $request->amount_from * $request->rate,
        ]);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction mise à jour');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction supprimée');
    }

    public function receipt(Transaction $transaction)
    {
        $transaction->load(['currencyFrom', 'currencyTo', 'user']);

        $pdf = Pdf::loadView('transactions.receipt', [
                   'transaction' => $transaction
    ]);

    // Téléchargement avec le nom de fichier basé sur la référence
        return $pdf->download('recu_'.$transaction->reference.'.pdf');
    }

}
