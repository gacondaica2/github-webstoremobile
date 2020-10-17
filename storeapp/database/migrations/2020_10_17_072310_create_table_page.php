<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Page', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->comment('user nguoi dang nhap');
            $table->string('title')->comment('duong dan');
            $table->string('content')->comment('noi dung');
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
        Schema::dropIfExists('table_page');
    }
}
