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
        Schema::create('team_yakos', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('user_uuid')->nullable();
            $table->string('team_name')->nullable();
            $table->string('team_fonction')->nullable();
            $table->string('team_image')->nullable();
            $table->longText('team_description')->nullable();
            $table->string('update_user_uuid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_yakos');
    }
};
