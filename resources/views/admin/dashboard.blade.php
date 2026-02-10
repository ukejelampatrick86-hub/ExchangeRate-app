@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard Admin — {{ \Carbon\Carbon::today()->format('d/m/Y') }}</h2>

    <div>
        <p>Total transactions du jour : <strong>{{ $totalTransactions }}</strong></p>
        <p>Montant total échangé : <strong>{{ $totalAmount }}</strong></p>
        <p>Caissier le plus actif : 
            <strong>{{ $topCashier ? $topCashier->user->name.' ('.$topCashier->total_transactions.' transactions)' : 'Aucun' }}</strong>
        </p>
    </div>

    <h3>Montant reçu par devise</h3>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Devise</th>
                <th>Montant reçu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactionsByCurrency as $t)
                <tr>
                    <td>{{ $t->currencyTo->code }}</td>
                    <td>{{ $t->total_received }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 🔹 Graphe Chart.js -->
    <h3>Graphique des montants reçus par devise</h3>
    <canvas id="currencyChart" width="400" height="200"></canvas>
</div>
@endsection

@section('scripts')
<!-- Charger Chart.js depuis CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('currencyChart').getContext('2d');
    const data = {
        labels: @json($transactionsByCurrency->pluck('currencyTo.code')),
        datasets: [{
            label: 'Montant reçu',
            data: @json($transactionsByCurrency->pluck('total_received')),
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };
    new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: true, text: 'Montant reçu par devise' }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
