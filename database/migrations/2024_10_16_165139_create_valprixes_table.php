<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('valprixes', function (Blueprint $table) {
            $table->id();
            $table->string('pvte');
            $table->foreignId('defprix_id')->constrained('defprixes');
            $table->foreignId('produit_id')->constrained('produits');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valprixes');
    }
};
