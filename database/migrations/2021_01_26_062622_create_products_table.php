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
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('sub_subcategory_id');
            $table->string('product_name');
            $table->string('slug');
            $table->string('product_code')->nullable();
            $table->string('product_brand');
            $table->string('product_image');
            $table->longtext('short_description');
            $table->longtext('long_description');
            $table->string('product_price');
            $table->integer('status')->default(0)->nullable();
            $table->integer('featured')->default(0)->nullable();
            $table->integer('view')->nullable();
            $table->string('comments')->nullable();
            $table->string('review')->nullable();
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
