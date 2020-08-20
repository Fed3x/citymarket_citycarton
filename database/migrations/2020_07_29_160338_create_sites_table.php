<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateSitesTable extends Migration
{

    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned();
            $table->primary('id');
            
            $table->string('code',10);
            $table->string('description',255);
            $table->string('address',255)->nullable();
        });
    }
    public function down()
    {
        Schema::dropIfExists('sites');
    }
}
