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
        Schema::connection('mysql3')->table('tbl_prestations', function (Blueprint $table) {
            $table->string('codeBanque')->nullable()->after('telPaiement');
            $table->string('codeGuichet')->nullable()->after('codeBanque');
            $table->string('numCompte')->nullable()->after('codeGuichet');
            $table->string('cleRIB')->nullable()->after('numCompte');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql3')->table('tbl_prestations', function (Blueprint $table) {
            //
        });
    }
};
