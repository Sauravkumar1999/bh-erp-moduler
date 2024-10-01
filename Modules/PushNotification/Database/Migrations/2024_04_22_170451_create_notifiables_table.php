<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifiablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifiables', function (Blueprint $table) {
            $table->unsignedBigInteger('push_notification_id');
            $table->string('notifiable_type')->comment('This represent Role or User Model');
            $table->unsignedBigInteger('notifiable_id')->comment('This represent relation Id Role or User');
            $table->foreign('push_notification_id')->references('id')->on('push_notifications')->cascadeOnDelete();
            $table->index(['push_notification_id', 'notifiable_type']);
            $table->unique(['push_notification_id', 'notifiable_type', 'notifiable_id'], 'notid_nottype_notifiableid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifiables');
    }
}
