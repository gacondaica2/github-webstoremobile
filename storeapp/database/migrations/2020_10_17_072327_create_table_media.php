<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_media', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('media id ');
            $table->string('name')->comment('ten');
            $table->string('size')->comment('kich co ');
            $table->string('demension')->comment('chieu dai rong  ');
            $table->string('type')->comment('loai hinh');
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
        Schema::dropIfExists('table_media');
    }
}
