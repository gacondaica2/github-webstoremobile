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
        Schema::create('Product', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50)->comment('title cua danh muc');
            $table->string('slug', 50)->comment('tieu de');
            $table->string('sku', 10)->comment('ma san pham');
            $table->integer('price')->comment('gia san pham');
            $table->integer('price_sale')->comment('gia khuyen mai');
            $table->longText('content')->nullable()->comment('noi dung san');
            $table->integer('qty')->comment('so luong');
            $table->integer('weight')->comment('khoi luong');
            $table->integer('height')->comment('chieu cao');
            $table->integer('width')->comment('chieu rong');
            $table->integer('media_id')->comment('media id ');
            $table->integer('category_id')->comment('category id');
            $table->text('option')->nullable()->comment('thong so san pham');
            $table->string('description', 255)->comment('mo ta so bo');
            $table->string('status', 2)->comment('trang thai');
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
