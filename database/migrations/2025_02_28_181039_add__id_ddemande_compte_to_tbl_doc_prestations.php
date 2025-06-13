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
        Schema::connection('mysql3')->table('tbl_doc_prestations', function (Blueprint $table) {
            $table->string('idDemandeCompte')->nullable()->after('idPrestation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql3')->table('tbl_doc_prestations', function (Blueprint $table) {
            //
        });
    }
};
