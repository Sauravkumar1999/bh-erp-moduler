<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMissingFieldsToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('business_name', 45)->nullable()->default(null)->after('url');
            $table->string('representative_name', 45)->nullable()->default(null)->after('business_name');
            $table->string('registration_number', 30)->nullable()->default(null)->after('representative_name');
            $table->string('address', 255)->nullable()->default(null)->after('registration_number');
            $table->date('registration_date')->nullable()->default(null)->after('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('business_name');
            $table->dropColumn('representative_name');
            $table->dropColumn('registration_number');
            $table->dropColumn('address');
            $table->dropColumn('registration_date');
        });
    }
}
