<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recharges', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->dateTime('date');
            $table->string('recharge_code');
            $table->integer('payment_type');
            $table->integer('status')->default(1);
            $table->string('note');
            $table->float('fee',11,2)->default(0);
            $table->float('value', 11, 3);
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
        Schema::dropIfExists('recharges');
    }
};
