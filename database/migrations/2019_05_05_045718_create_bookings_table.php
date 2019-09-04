<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('post_id');
            $table->string('payment_method',50)->nullable();
            $table->float('amount')->nullable();
            $table->string('provider_receive_product',20)->default('Pending');
            $table->string('provider_deliver_product',20)->default('Pending');
            $table->string('booking_for_days',20)->default('Unknown');
            $table->unsignedTinyInteger('admin_status')->default(0);
            $table->unsignedTinyInteger('provider_status')->default(0);
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
        Schema::dropIfExists('bookings');
    }
}
