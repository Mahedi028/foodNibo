<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('districts')){
            Schema::create('districts', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->unsignedBigInteger('division_id');
                $table->foreign('division_id')
                        ->references('id')
                        ->on('divisions')
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
        Schema::dropIfExists('districts');
    }
}
