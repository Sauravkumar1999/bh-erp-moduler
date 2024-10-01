<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForeignCompanyToProductCompanyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {

            if (Schema::hasColumn('products', 'company_id')) {
                $table->dropForeign(['company_id']);
                $table->dropColumn('company_id');
            }

            $table->bigInteger('company_id')->unsigned()->index()->nullable()->after('commission_type');
            $table->foreign('company_id')->references('id')->on('product_companies')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {

            if (Schema::hasColumn('products', 'company_id')) {
                $table->dropForeign(['company_id']);
                $table->dropColumn('company_id');
            }

            $table->foreignId('company_id')->nullable()->after('commission_type')->constrained()->cascadeOnUpdate()->nullOnDelete();
        });
    }
}
