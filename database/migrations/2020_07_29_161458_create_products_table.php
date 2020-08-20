<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned();
            $table->primary('id');
            
            $table->string('barcode',13);
            $table->string('description',255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
