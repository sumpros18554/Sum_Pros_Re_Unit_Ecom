<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('name', 100);
            $table->string('description', 500)->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->string('image_url', 255)->nullable();
            $table->string('status', 10)->default('ACTIVE');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
