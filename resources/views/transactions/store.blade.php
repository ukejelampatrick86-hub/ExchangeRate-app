@extends('layouts.app')

@section('title', 'Transaction enregistrée')

@section('content')
<h2>Transaction réussie ✅</h2>

<div class="card mb-3">
    <div class="card-body">
        <p><strong>Montant donné :</strong> {{ $transaction->amount_from }} {{ $transaction->currency_from }}</p>
        <p><strong>Montant reçu :</strong> {{ $transaction->amount_to }} {{ $transaction->currency_to }}</p>
        <p><strong>Date :</strong> {{ $transaction->created_at->format('d/m/Y H:i') }}</p>
    </div>
</div>

<a href="{{ route('transactions.index') }}" class="btn btn-primary">Retour aux transactions</a>
<a href="{{ route('transactions.create') }}" class="btn btn-success">Nouvelle transaction</a>
@endsection
