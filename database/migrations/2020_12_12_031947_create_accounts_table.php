<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->string('account_type')->nullable();
            $table->string('balance_type')->nullable();
            $table->string('final_account')->nullable();
            $table->integer('value_in')->nullable();
            $table->integer('value_out')->nullable();
            $table->integer('balance')->nullable();
            $table->string('accountable_type')->nullable();
            $table->integer('accountable_id')->nullable();
            $table->integer('column10')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('accounts');
    }
}
