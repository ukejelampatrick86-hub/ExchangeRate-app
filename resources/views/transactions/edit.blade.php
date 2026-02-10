@extends('layouts.app')

@section('title', 'Modifier transaction')

@section('content')
<h2>Modifier transaction</h2>

<form method="POST" action="{{ route('transactions.update', $transaction) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Montant donné</label>
        <input type="number" step="0.01" name="amount_from"
               value="{{ $transaction->amount_from }}"
               class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Taux</label>
        <input type="number" step="0.0001" name="rate"
               value="{{ $transaction->rate }}"
               class="form-control" required>
    </div>

    <button class="btn btn-warning">Mettre à jour</button>
</form>
@endsection
