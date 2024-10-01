<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allowances', function (Blueprint $table) {
            $table->id();
            $table->string('payment_month')->nullable();;
            $table->foreignId('member_id')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->decimal('headquarters_representative_allowance')->nullable();
            $table->decimal('organization_division_allowance')->nullable();
            $table->decimal('policy_allowance')->nullable();
            $table->decimal('other_allowances')->nullable();
            $table->decimal('income_tax')->nullable();
            $table->decimal('resident_tax')->nullable();
            $table->decimal('year_end_settlement')->nullable();
            $table->decimal('other_deductions_1')->nullable();
            $table->decimal('other_deductions_2')->nullable();
            $table->decimal('total_deduction')->nullable();
            $table->decimal('total_before_tax')->nullable();
            $table->decimal('deducted_amount_received')->nullable();
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
        Schema::dropIfExists('allowances');
    }
}
