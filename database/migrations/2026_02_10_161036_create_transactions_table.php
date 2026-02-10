<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            
            $table->string('reference')->unique();        // référence unique
            $table->foreignId('currency_from')->constrained('currencies'); // devise de départ
            $table->foreignId('currency_to')->constrained('currencies');   // devise d'arrivée
            $table->decimal('amount_from', 15, 2);       // montant à convertir
            $table->decimal('rate', 15, 6);              // taux de change
            $table->decimal('amount_to', 15, 2);         // montant converti
            $table->foreignId('user_id')->constrained('users'); // utilisateur qui fait la transaction
            $table->timestamp('transaction_date')->useCurrent(); // date de la transaction
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
