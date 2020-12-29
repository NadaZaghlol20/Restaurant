<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_subs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_id');
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->date('date');
            $table->string('notes');
            $table->foreign('sub_id')->references('id')->on('monthly_subs')->onDelete('cascade');
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
        Schema::dropIfExists('order_subs');
    }
}
