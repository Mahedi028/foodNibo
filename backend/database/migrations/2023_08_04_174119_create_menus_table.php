<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('menus')){
            Schema::create('menus', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title')->unique();
                $table->string('slug', 128)->unique()->nullable();
                $table->text('description');
                $table->decimal('price',8,2);
                $table->decimal('discount_price',8,2);
                $table->string('meal_thumbnail');
                $table->string('meal_img1');
                $table->string('meal_img2');
                $table->string('meal_img3');
                $table->string('ingredients')->nullable();
                $table->string('dietary_info')->nullable();
                $table->tinyInteger('in_stock')->default(1);
                $table->tinyInteger('active')->default(1);
                $table->unsignedBigInteger('category_id');
                $table->foreign('category_id')
                        ->references('id')
                        ->on('categories')
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
        Schema::dropIfExists('menus');
    }
}
