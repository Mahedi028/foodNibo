<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('menu_orders')){
            Schema::create('menu_orders', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('quantity');
                $table->decimal('price', 10, 2);
                $table->unsignedBigInteger('order_id');
                $table->unsignedBigInteger('menu_id');
                $table->foreign('order_id')
                        ->references('id')
                        ->on('orders')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
                $table->foreign('menu_id')
                        ->references('id')
                        ->on('menus')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_orders');
    }
}
