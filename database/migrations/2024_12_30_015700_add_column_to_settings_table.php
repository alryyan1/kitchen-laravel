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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('address');
            $table->string('cr');
            $table->string('vatin');
            $table->string('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            
            $table->dropColumn('address');
            $table->dropColumn('cr');
            $table->dropColumn('vatin');
            $table->dropColumn('phone');
        });
    }
};
