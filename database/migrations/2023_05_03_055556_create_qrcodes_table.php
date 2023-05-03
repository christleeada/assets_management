<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('qrcodes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('item_id');
        $table->string('code');
        $table->timestamps();

        $table->foreign('item_id')->references('id')->on('items');
    });
}

public function down()
{
    Schema::dropIfExists('qrcodes');
}

};
