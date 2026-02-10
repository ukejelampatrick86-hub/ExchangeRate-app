<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class TransactionsExport implements FromCollection, WithHeadings
{
    protected $type; // 'daily' ou 'monthly'

    public function __construct($type = 'daily')
    {
        $this->type = $type;
    }

    public function collection()
    {
        $query = Transaction::with(['user', 'currencyFrom', 'currencyTo']);

        if ($this->type === 'daily') {
            $query->whereDate('transaction_date', Carbon::today());
        } elseif ($this->type === 'monthly') {
            $query->whereMonth('transaction_date', Carbon::now()->month)
                  ->whereYear('transaction_date', Carbon::now()->year);
        }

        return $query->get()->map(function($t) {
            return [
                'Référence' => $t->reference,
                'Utilisateur' => $t->user->name,
                'Devise apportée' => $t->currencyFrom->code,
                'Montant apporté' => $t->amount_from,
                'Devise reçue' => $t->currencyTo->code,
                'Montant reçu' => $t->amount_to,
                'Date' => $t->transaction_date->format('d/m/Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Référence',
            'Utilisateur',
            'Devise apportée',
            'Montant apporté',
            'Devise reçue',
            'Montant reçu',
            'Date',
        ];
    }
}
