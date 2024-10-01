<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 45)->unique();
            $table->string('product_name', 150)->nullable();
            $table->text('product_description')->nullable();
            $table->decimal('product_price', 10, 2)->default(0);
            $table->enum('commission_type', ['fixed-price', 'with-ratio'])->default('fixed-price');
            $table->text('main_url')->nullable();
            $table->text('url_1')->nullable();
            $table->text('url_2')->nullable();
            $table->enum('urls_open_mode', ['same-window', 'new-window', 'new-tab'])->default('same-window');
            $table->json('sale_rights')->nullable()->comment('Company list who can sell this product');
            $table->json('approval_rights')->nullable()->comment('Users who can approve or register this product in sales');
            $table->string('group')->nullable();
            $table->string('branch_representative')->nullable();
            $table->decimal('referral_bonus', 10, 2)->nullable();
            $table->decimal('other_fees', 10, 2)->nullable();
            $table->decimal('bh_operating_profit', 10, 2)->nullable();
            $table->foreignId('user_id')->nullable()->comment('This represents the product created user')
                ->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->integer('exposer_order')->nullable();
            $table->json('product_commissions')->nullable()->comment('product commissions');
            $table->enum('sale_status', ['normal', 'pause', 'stop-selling', 'onetime-sell'])->default('normal');
            $table->boolean('contact_notifications')->default(true);
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('products');
        Schema::enableForeignKeyConstraints();
    }
}
