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
        Schema::create('level_menu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_level')->constrained('levels')->onDelete('cascade');
            $table->foreignId('id_menu')->constrained('menus')->onDelete('cascade');
            // $table->foreignId('level_id')->constrained('levels')->cascadeOnDelete();
            // $table->foreignId('id_menu')->constrained('menus')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_menu');
    }
};
