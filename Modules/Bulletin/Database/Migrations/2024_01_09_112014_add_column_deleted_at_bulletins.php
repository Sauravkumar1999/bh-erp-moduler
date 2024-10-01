<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDeletedAtBulletins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('bulletins', 'deleted_at')) {
            Schema::table('bulletins', function (Blueprint $table) {
                $table->softDeletes();
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
        if (Schema::hasColumn('bulletins', 'deleted_at')) {
            Schema::table('bulletins', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }
    }
}
