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
        // Drop existing columns if they exist
        if (Schema::hasColumn('medinvoice', 'status')) {
            Schema::table('medinvoice', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }

        if (Schema::hasColumn('medinvoice', 'medstatus')) {
            Schema::table('medinvoice', function (Blueprint $table) {
                $table->dropColumn('medstatus');
            });
        }

        if (Schema::hasColumn('medinvoice', 'method')) {
            Schema::table('medinvoice', function (Blueprint $table) {
                $table->dropColumn('method');
            });
        }

        if (Schema::hasColumn('medinvoice', 'methode')) {
            Schema::table('medinvoice', function (Blueprint $table) {
                $table->dropColumn('method');
            });
        }

        if (Schema::hasColumn('medinvoice', 'datetime')) {
            Schema::table('medinvoice', function (Blueprint $table) {
                $table->dropColumn('datetime');
            });
        }

        // Adding 'method' column
        Schema::table('medinvoice', function (Blueprint $table) {
            $table->string('method', 255)
                ->nullable()
                ->default('0')
                ->after('totalcost')
                ->comment('0: Pending Payment');
        });

        // Adding 'status' column
        Schema::table('medinvoice', function (Blueprint $table) {
            $table->integer('medstatus')
                ->nullable()
                ->default(0)
                ->after('method')
                ->comment('0: Pending  1: Receive');
        });

        // Adding 'datetime' column
        Schema::table('medinvoice', function (Blueprint $table) {
            $table->datetime('datetime')
                ->nullable()
                ->default(now())
                ->after('medstatus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medinvoice', function (Blueprint $table) {
            //
        });
    }
};
