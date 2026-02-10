<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        $currencies = [
            ['code' => 'XOF', 'name' => 'Franc CFA', 'symbol' => 'CFA', 'is_active' => true],
            ['code' => 'USD', 'name' => 'US Dollar', 'symbol' => '$', 'is_active' => true],
            ['code' => 'EUR', 'name' => 'Euro', 'symbol' => '€', 'is_active' => true],
            ['code' => 'GHS', 'name' => 'Ghana Cedi', 'symbol' => 'GH₵', 'is_active' => true],
            ['code' => 'NGN', 'name' => 'Nigerian Naira', 'symbol' => '₦', 'is_active' => true],
        ];

        foreach ($currencies as $currency) {
            Currency::firstOrCreate(['code' => $currency['code']], $currency);
        }

        $this->command->info('Base currencies seeded successfully!');
    }
}
