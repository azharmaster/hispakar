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
        Schema::table('doctor', function (Blueprint $table) {
            if (Schema::hasColumn('doctor', 'img')) {
                $table->dropColumn('img');
            }

            if (Schema::hasColumn('doctor', 'profilepic')) {
                $table->dropColumn('profilepic');
            }
        });

        Schema::table('nurse', function (Blueprint $table) {
            if (Schema::hasColumn('nurse', 'img')) {
                $table->dropColumn('img');
            }

            if (Schema::hasColumn('nurse', 'profilepic')) {
                $table->dropColumn('profilepic');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctor', function (Blueprint $table) {
            $table->string('img')->nullable();
            $table->string('profilepic')->nullable();
        });

        Schema::table('nurse', function (Blueprint $table) {
            $table->string('img')->nullable();
            $table->string('profilepic')->nullable();
        });
    }
};
