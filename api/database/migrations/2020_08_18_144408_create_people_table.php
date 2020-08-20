<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->boolean('business')->default(false);
            $table->boolean('supplier')->default(false);
            $table->string('name');
            $table->string('nickname');
            $table->string('email');
            $table->string('mobile');
            $table->boolean('whatsapp')->default(false);
            $table->string('phone');
            $table->string('nid');
            $table->string('ssn');
            $table->string('zipcode');
            $table->string('street');
            $table->string('streetNumber');
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
