<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->boolean('status')->default(1);
            $table->string('url', 100)->nullable();
            $table->string('business_name', 45)->nullable()->default(null);
            $table->string('representative_name', 45)->nullable()->default(null);
            $table->string('registration_number', 30)->nullable()->default(null);
            $table->string('address', 255)->nullable()->default(null);
            $table->date('registration_date')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_companies');
    }
}
