<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('product_sale_day');
            $table->foreignId('product_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('fee_type')->nullable();
            $table->double('product_price')->default(0);
            $table->string('remark')->nullable();
            $table->double('sales_price')->default(0);
            $table->string('sales_type')->default(0);
            $table->string('take')->nullable();
            $table->integer('number_of_sales')->default(0);
            $table->text('sales_information')->nullable();
            $table->double('operating_income')->default(0);
            $table->string('sales_status')->nullable();
            $table->foreignId('user_id')->comment('Person who create the sale')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
