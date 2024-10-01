<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnViewCountToBulletins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('bulletins', 'view_count')) {
            Schema::table('bulletins', function (Blueprint $table) {
                $table->integer('view_count')->default(0)->after('user_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('bulletins', 'view_count')) {
            Schema::table('bulletins', function (Blueprint $table) {
                $table->dropColumn('view_count');
            });
        }
    }
}
