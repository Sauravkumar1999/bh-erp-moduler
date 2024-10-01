<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            if(!Schema::hasColumn('users', 'company_id')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->unsignedBigInteger('company_id')->nullable()->after('final_confirmation');
                    $table->foreign('company_id')->references('id')->on('companies');
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
        if(Schema::hasColumn('users', 'company_id')){
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign('company_id');
            });
        }
    }
}
