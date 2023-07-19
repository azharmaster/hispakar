<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('appointment', function (Blueprint $table) {
            DB::statement("ALTER TABLE `appointment` CHANGE `status` `status` INT NULL DEFAULT NULL COMMENT '0.pending 1.confirm 2.reject 3.cancel'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointment', function (Blueprint $table) {
            DB::statement("ALTER TABLE `appointment` CHANGE `status` `status` INT NULL DEFAULT NULL COMMENT '0:cancel 1.confirm'");
        });
    }
};
