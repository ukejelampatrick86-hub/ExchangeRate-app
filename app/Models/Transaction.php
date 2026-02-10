<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'currency_from',
        'currency_to',
        'amount_from',
        'rate',
        'amount_to',
        'user_id',
        'transaction_date',
    ];

    // 🔹 Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currencyFrom()
    {
        return $this->belongsTo(Currency::class, 'currency_from');
    }

    public function currencyTo()
    {
        return $this->belongsTo(Currency::class, 'currency_to');
    }
}
