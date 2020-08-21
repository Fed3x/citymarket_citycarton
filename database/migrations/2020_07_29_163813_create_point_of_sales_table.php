<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointOfSalesTable extends Migration
{
    public function up()
    {
        Schema::create('point_of_sales', function (Blueprint $table) {
            $table->id();
            $table->string('number', 3);
            $table->string('ip_address', 15)->unique();

            $table->bigInteger('site_id')->unsigned();
            $table->foreign('site_id')->references('id')->on('sites');
            
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('point_of_sales');
    }
}
