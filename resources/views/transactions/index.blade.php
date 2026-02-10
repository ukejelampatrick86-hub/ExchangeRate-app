@extends('layouts.app')

@section('title', 'Liste des transactions')

@section('content')
<h2>Transactions</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Montant donné</th>
            <th>Devise</th>
            <th>Montant reçu</th>
            <th>Devise</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->amount_from }}</td>
                <td>{{ $transaction->currency_from }}</td>
                <td>{{ $transaction->amount_to }}</td>
                <td>{{ $transaction->currency_to }}</td>
                <td>
                    <a href="{{ route('transactions.show', $transaction) }}" class="btn btn-sm btn-info">Voir</a>
                    <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-sm btn-warning">Modifier</a>
                    <a href="{{ route('transactions.receipt', $transaction->id) }}" target="_blank">Télécharger le reçu PDF</a>
                    <a href="{{ route('transactions.export.daily') }}" target="_blank">Exporter les transactions du jour</a> |
                    <a href="{{ route('transactions.export.monthly') }}" target="_blank">Exporter les transactions du mois</a>

                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Supprimer ?')">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
