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
        Schema::create('trans_order', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->date('order_date');
            $table->foreignId('id_customer')->constrained('customer');
            $table->foreignId('id_user')->constrained('users');
            $table->enum('order_status', ['0', '1'])->default('0');
            $table->integer('order_pay')->nullable();
            $table->integer('order_change')->nullable();
        
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trans_order');
    }
};
