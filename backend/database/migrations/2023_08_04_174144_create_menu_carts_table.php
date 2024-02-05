<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('menu_image');
            $table->string('menu_name');
            $table->string('quantity');
            $table->string('unit_price');
            $table->string('total_price');
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')
                    ->references('id')
                    ->on('menus')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
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
        Schema::dropIfExists('menu_carts');
    }
}
