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
        Schema::connection('mysql3')->create('tbl_prestations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->index()->nullable();
            $table->string('idOtp')->nullable();
            $table->string('idcontrat')->nullable();
            $table->string('typeprestation')->nullable();
            $table->string('idclient')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('datenaissance')->nullable();
            $table->string('lieunaissance')->nullable();
            $table->string('sexe')->nullable();
            $table->string('cel')->nullable();
            $table->string('tel')->nullable();
            $table->string('email')->nullable();
            $table->longText('msgClient')->nullable();
            $table->string('lieuresidence')->nullable();
            $table->string('montantSouhaite')->nullable();
            $table->string('moyenPaiement')->nullable();
            $table->string('Operateur')->nullable();
            $table->string('telPaiement')->nullable();
            $table->string('IBAN')->nullable();
            $table->string('saisiepar')->nullable();
            $table->string('traiterpar')->nullable();
            $table->string('villedeclaration')->nullable();
            $table->longText('observationtraitement')->nullable();
            $table->boolean('estMigree')->default(false)->nullable();
            $table->string('etape')->default('1');
            $table->string('envoimail')->nullable();
            $table->longText('mailtraitement')->nullable();
            $table->string('etat')->default('Actif');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql3')->dropIfExists('tbl_prestations');
    }
};
