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
        Schema::connection('mysql')->create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address')->nullable();
            $table->string('uuid_activity')->nullable();
            $table->string('product_uuid')->nullable();
            $table->string('reseau_uuid')->nullable();
            $table->string('prodformule_uuid')->nullable();
            $table->timestamps(); // Inclut created_at pour suivre la date et l'heure
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql')->dropIfExists('visitors');
    }
};
