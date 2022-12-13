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
        Schema::create('plan_history', function (Blueprint $table) {
            $table->id();
            $table->integer('plan_id');
            $table->integer('motel_id');
            $table->integer('day')->nullable();
            $table->integer('status')->default(1);
            $table->integer('parent_id')->default(0)->nullable();
            $table->integer('is_first')->default(0);
            $table->integer('user_id');
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
        Schema::dropIfExists('plan_history');
    }
};
