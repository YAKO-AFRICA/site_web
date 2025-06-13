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
        Schema::connection('mysql3')->create('tbl_motifrejetprestations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('keyword')->nullable();
            $table->longText('libelle')->nullable();
            $table->boolean('etat')->default(1);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql3')->dropIfExists('tbl_motifrejetprestations');
    }
};
