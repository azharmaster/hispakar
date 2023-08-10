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
        Schema::table('medrecord', function (Blueprint $table) {
            DB::statement('ALTER TABLE medrecord CHANGE COLUMN invoice_number refnum INT(11)');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medrecord', function (Blueprint $table) {
            DB::statement('ALTER TABLE medrecord CHANGE COLUMN invoice_number refnum INT(11)');
        });
    }
};
