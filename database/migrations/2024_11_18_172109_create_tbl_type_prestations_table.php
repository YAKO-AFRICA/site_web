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
        Schema::connection('mysql3')->create('tbl_type_prestations', function (Blueprint $table) {
            $table->id();
            $table->string('libelle')->nullable();
            $table->longText('description')->nullable();
            $table->string('impact')->nullable();
            $table->string('etat')->default('Actif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql3')->dropIfExists('tbl_type_prestations');
    }
};
