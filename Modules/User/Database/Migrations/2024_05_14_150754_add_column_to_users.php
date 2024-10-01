<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('submitted_date')->nullable()->after('final_confirmation');
            $table->timestamp('deposit_date')->nullable()->after('submitted_date');
            $table->timestamp('start_date')->nullable()->after('deposit_date');
            $table->timestamp('end_date')->nullable()->after('start_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('submitted_date');
            $table->dropColumn('deposit_date');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
        });
    }
}
