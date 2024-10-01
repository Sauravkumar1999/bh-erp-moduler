<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRightsColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumns('products', ['sale_rights_disclosure', 'approval_rights_disclosure'])) {
                $table->enum('sale_rights_disclosure', ['full', 'partial'])->default('partial')
                    ->after('exposer_order');
                $table->enum('approval_rights_disclosure', ['full', 'partial'])->default('partial')
                    ->after('sale_rights_disclosure');
            }
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
            $table->dropColumn(['sale_rights_disclosure', 'approval_rights_disclosure']);
        });
    }
}
