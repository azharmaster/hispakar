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
            $table->integer('status')->nullable()->comment('1.done')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // If you need to rollback the migration, you can use the following code:
        Schema::table('medrecord', function (Blueprint $table) {
            $table->integer('status')->nullable()->change();
        });
    }
};
