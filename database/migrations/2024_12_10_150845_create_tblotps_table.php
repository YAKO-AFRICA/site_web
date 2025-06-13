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
        Schema::connection('mysql3')->create('tblotps', function (Blueprint $table) {
            $table->id();
            $table->string('codeOTP')->nullable();
            $table->integer('used')->default(0);
            $table->string('operation_type')->nullable();
            $table->string('contact_method')->nullable();
            $table->string('contact')->nullable();
            $table->integer('otp_attempts')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql3')->dropIfExists('tblotps');
    }
};
