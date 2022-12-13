<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motels', function (Blueprint $table) {
            $table->id();
            $table->string('room_number');
            $table->float('price', 11, 3)->default(0);
            $table->float('area', 11, 3)->default(0);
            $table->integer('area_id');
            $table->longText('description')->nullable();
            $table->text('image_360')->nullable();
            $table->text('photo_gallery')->nullable();
            $table->integer('status')->default(0);
            $table->integer('max_people')->default(0);
            $table->date('start_time')->nullable();
            $table->date('end_time')->nullable();
            $table->longText('services')->nullable();
            $table->integer('category_id')->default(1);
            $table->longText('video')->nullable();
            $table->longText('data_post')->nullable();
            $table->float('electric_money', 11, 2)->default(0);
            $table->float('warter_money', 11, 2)->default(0);
            $table->float('wifi', 11, 2)->default(0);
            $table->integer('money_deposit')->nullable();
            $table->integer('day_deposit')->nullable();
            $table->longText('transfer_infor')->nullable();
            $table->integer('view')->default(0);
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
        Schema::dropIfExists('motels');
    }
};
