<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUserColumnsFromProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumns('products', ['sale_rights', 'approval_rights'])) {
                $table->dropColumn(['sale_rights', 'approval_rights']);
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
            $table->json('sale_rights')->nullable()->after('urls_open_mode')
                ->comment('Company list who can sell this product');
            $table->json('approval_rights')->nullable()->after('sale_rights')
                ->comment('Users who can approve or register this product in sales');
        });
    }
}
