<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class ChangeFeeTypeColumnTypeSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("ALTER TABLE `".env('DB_DATABASE')."`.`sales` CHANGE COLUMN `fee_type` `fee_type` ENUM('fixed-price', 'with-ratio') NOT NULL DEFAULT 'fixed-price' ;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        DB::unprepared("ALTER TABLE `".env('DB_DATABASE')."`.`sales` CHANGE COLUMN `fee_type` `fee_type` VARCHAR(45) NULL DEFAULT NULL ;");
    }
}
