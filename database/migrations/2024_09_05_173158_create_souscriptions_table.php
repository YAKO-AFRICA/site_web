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
        Schema::create('souscriptions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('user_uuid')->nullable();
            $table->string('code')->nullable();
            $table->string('product_uuid')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('mail_object')->nullable();
            $table->longText('mail_content')->nullable();
            $table->string('etat')->default('Actif')->nullable();
            $table->string('status')->default('draft')->nullable();
            $table->string('type_mail')->nullable();  // contact , souscription
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('souscriptions');
    }
};
