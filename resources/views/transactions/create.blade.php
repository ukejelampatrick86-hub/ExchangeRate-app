@extends('layouts.app')

@section('title', __('app.create_transaction'))

@section('content')
<h2>{{ __('app.create_transaction') }}</h2>

<form method="POST" action="{{ route('transactions.store') }}">
    @csrf

    <div class="mb-3">
        <label>{{ __('app.amount_from') }}</label>
        <input type="number" step="0.01" name="amount_from" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>{{ __('app.currency_from') }}</label>
        <input type="text" name="currency_from" class="form-control" maxlength="3" required>
    </div>

    <div class="mb-3">
        <label>{{ __('app.rate') }}</label>
        <input type="number" step="0.0001" name="rate" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>{{ __('app.currency_to') }}</label>
        <input type="text" name="currency_to" class="form-control" maxlength="3" required>
    </div>

    <div class="mb-3">
        <label>{{ __('app.amount_to') }}</label>
        <input type="number" step="0.01" name="amount_to" class="form-control" readonly>
    </div>

    <button type="submit" class="btn btn-primary">{{ __('app.create_transaction') }}</button>
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const amountInput = document.querySelector('input[name="amount_from"]');
    const rateInput = document.querySelector('input[name="rate"]');
    const receivedInput = document.querySelector('input[name="amount_to"]');

    amountInput.addEventListener('input', calculate);
    rateInput.addEventListener('input', calculate);

    function calculate() {
        const amount = parseFloat(amountInput.value) || 0;
        const rate = parseFloat(rateInput.value) || 0;
        const received = amount * rate;
        receivedInput.value = received.toFixed(2);
    }
});
</script>
@endpush
