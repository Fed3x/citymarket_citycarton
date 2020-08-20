<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentCartonsTable extends Migration
{
    public function up()
    {
        Schema::create('sent_cartons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('carton_id');
            $table->foreign('carton_id')->references('id')->on('cartons');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('sent_cartons');
    }
}
