<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('tieu de');
            $table->string('slug')->comment('tieu de');
            $table->string('status')->comment('trang thai');
            $table->string('parent_id')->comment('cha con');
            $table->string('product_id')->comment('id product');
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
        Schema::dropIfExists('table_categories');
    }
}
