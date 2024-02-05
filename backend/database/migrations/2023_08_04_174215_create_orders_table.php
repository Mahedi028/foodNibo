<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('orders')){
            Schema::create('orders', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name', 128);
                $table->string('email', 128);
                $table->string('phone', 32);
                $table->text('address');
                $table->string('postal_code', 16);
                $table->decimal('total_amount', 10, 2);
                $table->decimal('discount_amount', 10, 2)->default(0.00);
                $table->string('payment_status', 16);
                $table->string('status', 16);
                $table->string('payment_type');
                $table->string('payment_method')->nullable();
                $table->string('transaction_id');
                $table->string('currency');
                $table->float('amount',8,2);
                $table->string('order_number');
                $table->string('invoice_no');
                $table->string('order_date');
                $table->string('order_month');
                $table->string('order_year');
                $table->string('confirmed_date')->nullable();
                $table->string('shipped_date')->nullable();
                $table->string('delivered_date')->nullable();
                $table->string('cancel_date')->nullable();
                $table->string('return_date')->nullable();
                $table->string('return_reason')->nullable();
                $table->text('payment_details', 16)->nullable();
                $table->string('operational_status', 16)->default('pending');
                $table->unsignedInteger('processed_by')->nullable();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('division_id');
                $table->unsignedBigInteger('district_id');
                $table->unsignedBigInteger('state_id');
                $table->foreign('user_id')
                        ->references('id')
                        ->on('users')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
                $table->foreign('division_id')
                        ->references('id')
                        ->on('divisions')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
                $table->foreign('district_id')
                        ->references('id')
                        ->on('districts')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
                $table->foreign('state_id')
                        ->references('id')
                        ->on('states')
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
        Schema::dropIfExists('orders');
    }
}
