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
        Schema::connection('mysql3')->create('tbl_sinistres', function (Blueprint $table) {
            $table->id();
            $table->string('code')->index()->nullable();
            $table->string('nomDecalarant')->nullable();
            $table->string('idcontrat')->nullable();
            $table->string('prenomDecalarant')->nullable();
            $table->string('datenaissanceDecalarant')->nullable();
            $table->string('lieunaissanceDecalarant')->nullable();
            $table->string('filiation')->nullable();
            $table->string('lieuresidenceDecalarant')->nullable();
            $table->string('celDecalarant')->nullable();
            $table->string('emailDecalarant')->nullable();
            $table->string('genreAssuree')->nullable();
            $table->string('nomAssuree')->nullable();
            $table->string('prenomAssuree')->nullable();
            $table->string('datenaissanceAssuree')->nullable();
            $table->string('lieunaissanceAssuree')->nullable();
            $table->string('professionAssuree')->nullable();
            $table->string('lieuresidenceAssuree')->nullable();
            $table->string('natureSinistre')->nullable();
            $table->string('decesAccidentel')->nullable();
            $table->string('declarationTardive')->nullable();
            $table->string('dateSinistre')->nullable();
            $table->string('causeSinistre')->nullable();
            $table->string('lieuConservation')->nullable();
            $table->string('montantBON')->nullable();
            $table->string('dateLevee')->nullable();
            $table->string('lieuLevee')->nullable();
            $table->string('dateInhumation')->nullable();
            $table->string('lieuInhumation')->nullable();
            $table->string('codeAssuree')->nullable();
            $table->string('moyenPaiement')->nullable();
            $table->string('Operateur')->nullable();
            $table->string('telPaiement')->nullable();
            $table->string('codebanque')->nullable();
            $table->string('codeagence')->nullable();
            $table->string('numcompte')->nullable();
            $table->string('clerib')->nullable();
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
        Schema::connection('mysql3')->dropIfExists('tbl_sinistres');
    }
};
