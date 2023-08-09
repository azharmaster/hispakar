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
        Schema::table('medrecord', function (Blueprint $table) {
            $table->renameColumn('invoice_number', 'refnum');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medrecord', function (Blueprint $table) {
            $table->renameColumn('refnum', 'invoice_number');
        });
    }
};
