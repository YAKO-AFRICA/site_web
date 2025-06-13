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
        Schema::create('actualities', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('user_uuid')->nullable();
            $table->string('product_uuid')->nullable();
            $table->string('title')->nullable();
            $table->longText('comment')->nullable();
            $table->string('image_url')->nullable();
            $table->string('video_url')->nullable();
            $table->longText('citation')->nullable();
            $table->string('etat')->default('Actif');
            $table->string('update_user_uuid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actualities');
    }
};
