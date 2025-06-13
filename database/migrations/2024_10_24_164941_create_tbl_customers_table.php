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
        Schema::connection('mysql2')->create('tbl_customers', function (Blueprint $table) {
            $table->id();
            $table->string('login')->nullable();
            $table->string('password')->nullable();
            $table->string('activer')->nullable();
            $table->string('estajour')->nullable();
            $table->string('memberok')->nullable();
            $table->string('idmembre')->nullable();
            $table->boolean('isFirstLog')->default(false); // Ajout d'une colonne booléenne
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql2')->dropIfExists('tbl_customers');
    }
};
