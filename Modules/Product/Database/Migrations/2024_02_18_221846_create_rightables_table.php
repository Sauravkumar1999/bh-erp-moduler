<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRightablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rightables', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->string('rightable_type')->comment('This represent Company or User Model');
            $table->unsignedBigInteger('rightable_id')
                ->comment('This represent relation Id Company or User');
            $table->enum('type', ['sale_rights', 'approval_rights']);
            $table->integer('odr_app')->unsigned()->default(0)
                ->comment('This is to set the order of appearance of the products in sales person pages');
            $table->boolean('product_expose')->default(0)
                ->comment('This is to on or off product visibility in sales person pages');
            $table->foreign('product_id')->references('id')->on('products')
                ->cascadeOnDelete();
            $table->index(['rightable_id', 'rightable_type']);
            $table->unique(['product_id', 'rightable_type', 'rightable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rightables');
    }
}
