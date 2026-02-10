@extends('layouts.app')

@section('title', 'Détails transaction')

@section('content')
<h2>Détails de la transaction</h2>

<ul class="list-group">
    <li class="list-group-item">Montant donné : {{ $transaction->amount_from }} {{ $transaction->currency_from }}</li>
    <li class="list-group-item">Montant reçu : {{ $transaction->amount_to }} {{ $transaction->currency_to }}</li>
    <li class="list-group-item">Date : {{ $transaction->created_at }}</li>
</ul>

<a href="{{ route('transactions.index') }}" class="btn btn-secondary mt-3">Retour</a>
@endsection
