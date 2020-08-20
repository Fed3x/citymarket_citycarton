<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartonsTable extends Migration
{

    public function up()
    {
        Schema::create('cartons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('barcode', 13);
            
            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('carton_type_id');
            $table->foreign('carton_type_id')->references('id')->on('carton_types');

            $table->bigInteger('point_of_sale_id')->nullable();
            $table->foreign('point_of_sale_id')->references('id')->on('point_of_sales');

            $table->bigInteger('site_id');
            $table->foreign('site_id')->references('id')->on('sites');

            $table->unique(["barcode", "carton_type_id"], 'barcode_carton_type_id');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cartons');
    }
}
