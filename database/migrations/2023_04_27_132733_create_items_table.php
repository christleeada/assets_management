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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->binary('qrcode_image')->nullable();
            $table->string('item_name');
            $table->string('purchased_as');
            $table->longText('image')->nullable();
            $table->unsignedBigInteger('post_status_id');
            $table->unsignedBigInteger('unit_type');
            $table->unsignedBigInteger('item_category');
            $table->decimal('price', 8, 2);
            $table->string('brand');
            $table->string('remarks')->nullable();
            $table->text('description');
            $table->text('advice')->nullable();
            $table->integer('quantity');
            $table->date('date_purchased')->nullable()->default(null);
            $table->timestamps();
    
            $table->foreign('post_status_id')->references('id')->on('statuses');
            $table->foreign('unit_type')->references('id')->on('unit_types');
            $table->foreign('item_category')->references('id')->on('item_categories');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
