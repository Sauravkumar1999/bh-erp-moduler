<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('image_register')->default(1);
            $table->boolean('text_register')->default(1);
            $table->text('portfolio')->nullable();
            $table->json('sns')->nullable()->comment('use this field for save SNS information');
            // SNS saving pattern
//            [
//                'facebook': { 'status': true, 'url': '' },
//                'instagram': { 'status': true, 'url': '' },
//                'kakaotalk': { 'status': true, 'url': '' },
//                'blog': { 'status': true, 'url': '' },
//            ]

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('user_settings');
    }
}
