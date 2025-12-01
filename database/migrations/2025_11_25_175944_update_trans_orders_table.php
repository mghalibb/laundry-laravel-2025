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
        Schema::table('trans_order', function (Blueprint $table) {
            $table->integer('tax')->default(0)->after('order_pay');
            $table->integer('admin_fee')->default(0)->after('tax');
        });

        Schema::table('trans_order_detail', function (Blueprint $table) {
            $table->decimal('qty', 8, 3)->change(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trans_order', function (Blueprint $table) {
            $table->dropColumn(['tax', 'admin_fee']);
        });

        Schema::table('trans_order_detail', function (Blueprint $table) {
            $table->integer('qty')->change();
        });
    }
};
