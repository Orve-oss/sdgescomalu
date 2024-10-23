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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('Rais_Soc');
            $table->string('Contact');
            $table->string('Adresse');
            $table->boolean('Actif')->default(1);
            $table->date('created_date')->default(now());
            $table->foreignId('defprix_id')->nullable()->constrained('defprixes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
