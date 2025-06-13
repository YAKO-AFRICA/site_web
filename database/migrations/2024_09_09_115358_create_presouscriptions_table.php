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
        Schema::create('presouscriptions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('code')->nullable();
            $table->string('product_uuid')->nullable();
            $table->string('customer_firstname')->nullable();
            $table->string('customer_lastname')->nullable();
            $table->string('customer_civility')->nullable();
            $table->string('customer_birthday')->nullable();
            $table->string('customer_placebirth')->nullable();
            $table->string('customer_job')->nullable();
            $table->string('customer_residence')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_whatsapp')->nullable();
            $table->string('object')->nullable();
            $table->text('content')->nullable();
            $table->string('etat')->default('Actif');
            $table->string('status')->default('En attente');
            $table->string('type')->nullable();
            $table->string('update_status_user_uuid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presouscriptions');
    }
};