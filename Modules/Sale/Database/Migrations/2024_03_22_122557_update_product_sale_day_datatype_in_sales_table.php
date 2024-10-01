<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateProductSaleDayDatatypeInSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("ALTER TABLE `".env('DB_DATABASE')."`.`sales` CHANGE COLUMN `product_sale_day` `product_sale_day` DATETIME NOT NULL ;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("ALTER TABLE `".env('DB_DATABASE')."`.`sales` CHANGE COLUMN `product_sale_day` `product_sale_day` VARCHAR(255) NOT NULL ;");
    }
}
