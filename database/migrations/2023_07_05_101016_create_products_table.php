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
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('product_code');
            $table->string('product_qty');
            $table->string('product_tags');
            $table->string('product_size');
            $table->string('product_color');
            $table->string('selling_price');
            $table->string('discount_price');
            $table->text('short_disc');
            $table->text('long_disc');
            $table->string('product_thumbnail');
            $table->string('vendor_id');
            $table->integer('hot_deals');
            $table->integer('featured');
            $table->integer('special_offer');
            $table->integer('special_deals');
            $table->integer('status')->default(0);
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
