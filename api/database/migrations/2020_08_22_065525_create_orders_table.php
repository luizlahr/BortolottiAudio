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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("status")->default(1);
            $table->float("credit", 9, 2)->default(0);
            $table->biginteger("customer_id")->unsigned();
            $table->dateTime("due_to")->nullable();
            $table->dateTime("quoted_at")->nullable();
            $table->dateTime("approved_at")->nullable();
            $table->dateTime("finished_at")->nullable();
            $table->dateTime("delivered_at")->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("customer_id")->references("id")->on('people');
        });
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
