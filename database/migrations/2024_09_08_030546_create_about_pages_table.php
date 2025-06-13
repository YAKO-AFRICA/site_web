<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('about_pages', function (Blueprint $table) {
        $table->id();
        $table->uuid('uuid')->index();
        $table->string('title')->nullable();
        $table->string('nomPCA')->nullable();
        $table->text('content')->nullable();
        $table->string('image')->nullable();
        $table->string('section')->default('section');
        $table->string('update_user_uuid')->nullable();
        $table->timestamps();
    });
}
};
