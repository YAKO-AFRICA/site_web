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
        Schema::create('comment_actualities', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('actuality_uuid')->nullable();
            $table->string('user_uuid')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_website')->nullable();
            $table->string('comment')->nullable();
            $table->string('status')->default('Draft');
            $table->string('etat')->default('Actif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_actualities');
    }
};
