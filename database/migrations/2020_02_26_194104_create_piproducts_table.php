<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piproducts', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->string("product_name");
            $table->integer("product_stock");
            $table->integer("product_price");
            $table->integer("product_qty");
            $table->integer("product_dis");
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
        Schema::dropIfExists('piproducts');
    }
}
