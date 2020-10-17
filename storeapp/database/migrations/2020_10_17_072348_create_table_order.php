<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_order', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->comment('id nguoi mua');
            $table->string('sub_total')->comment('tong tien');
            $table->string('delivery_id')->comment('id delivery');
            $table->string('total')->comment('tong tien don hang');
            $table->string('paymod')->comment('hinh thuc thanh toan');
            $table->string('status')->comment('trang thai');
            $table->string('note')->comment('ghi chu');
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
        Schema::dropIfExists('table_order');
    }
}
