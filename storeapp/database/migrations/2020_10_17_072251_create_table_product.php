<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_product', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('title cua danh muc');
            $table->string('slug')->comment('tieu de');
            $table->string('sku')->comment('ma san pham');
            $table->integer('price')->comment('gia san pham');
            $table->integer('price_sale')->comment('gia khuyen mai');
            $table->string('qty')->comment('so luong');
            $table->string('weight')->comment('khoi luong');
            $table->string('height')->comment('chieu cao');
            $table->string('width')->comment('chieu rong');
            $table->string('media_id')->comment('media id ');
            $table->string('category_id')->comment('category id');
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
        Schema::dropIfExists('table_product');
    }
}
