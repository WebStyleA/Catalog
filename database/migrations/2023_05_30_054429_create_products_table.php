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
            $table->string("name",255);
            $table->text("description");
            $table->decimal("cost");
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("manufactures_id");
            $table->foreign("category_id")->references("id")->on("categories");
            $table->foreign("manufactures_id")->references("id")->on("manufactures");
            $table->string("photo");
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
