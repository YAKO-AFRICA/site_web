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
        Schema::connection('mysql2')->create('tbl_creation_comptes', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('email')->nullable();
            $table->string('cel')->nullable();
            $table->string('login')->nullable();
            $table->string('password')->nullable();
            $table->string('estClient')->nullable()->default(0);
            $table->boolean('estnotifie')->nullable();
            $table->string('estnotifieLe')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql2')->dropIfExists('tbl_creation_comptes');
    }
};
