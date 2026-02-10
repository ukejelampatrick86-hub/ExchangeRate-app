<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reçu de transaction</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .container { width: 80%; margin: auto; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td, th { border: 1px solid #000; padding: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reçu de Transaction</h2>

        <table>
            <tr>
                <th>Référence</th>
                <td>{{ $transaction->reference }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $transaction->transaction_date->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <th>Montant apporté</th>
                <td>{{ $transaction->amount_from }} {{ $transaction->currencyFrom->code }}</td>
            </tr>
            <tr>
                <th>Devise reçue</th>
                <td>{{ $transaction->amount_to }} {{ $transaction->currencyTo->code }}</td>
            </tr>
        </table>
        <h2>{{ __('app.receipt_title') }}</h2>

         <table>
    <tr>
        <th>{{ __('app.reference') }}</th>
        <td>{{ $transaction->reference }}</td>
    </tr>
    <tr>
        <th>{{ __('app.date') }}</th>
        <td>{{ $transaction->transaction_date->format('d/m/Y H:i') }}</td>
    </tr>
    <tr>
        <th>{{ __('app.amount_from') }}</th>
        <td>{{ $transaction->amount_from }} {{ $transaction->currencyFrom->code }}</td>
    </tr>
    <tr>
        <th>{{ __('app.currency_to') }}</th>
        <td>{{ $transaction->amount_to }} {{ $transaction->currencyTo->code }}</td>
    </tr>
      </table>
    </div>
</body>
</html>
