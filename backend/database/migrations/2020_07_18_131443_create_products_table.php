<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id');
            $table->integer('sub_id');
            $table->integer('b_id');
            $table->string('product_name');
            $table->string('product_code');
            $table->string('product_quantity');
            $table->longText('product_details')->nullable();
            $table->string('product_color')->nullable();
            $table->string('product_size')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('video_link')->nullable();
            $table->string('main_slider')->nullable();
            $table->string('mid_slider')->nullable();
            $table->string('hot_deal')->nullable();
            $table->string('hot_new')->nullable();
            $table->string('best_rated')->nullable();
            $table->string('buyone_getone')->nullable();
            $table->string('trend')->nullable();
            $table->string('image_one')->nullable();
            $table->string('image_two')->nullable();
            $table->string('image_three')->nullable();
            $table->string('status');

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
        Schema::dropIfExists('products');
    }
}
