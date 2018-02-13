<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->default(0);
            $table->integer('category_id2')->default(0);
            $table->integer('brand_id')->default(0);
            $table->integer('collection_id')->default(0);
            $table->string('title');
            $table->string('slug');
            $table->integer('price')->default(0);
            $table->integer('price_1c')->default(0);;
            $table->integer('price_old')->default(0);
            $table->integer('price_action')->default(0);
            $table->boolean('publish')->defaul(0);
            $table->text('description')->nullable();
            $table->integer('sort')->default(0);
            $table->integer('hits')->default(0);
            $table->string('code');
            $table->string('code_1c')->nullable();
            $table->string('code_1c_nom')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('quantity_all_1c')->default(0);
            $table->integer('quantity_nom')->default(0);
            $table->integer('quantity_excel')->default(0);
            $table->boolean('novinka')->default(0);
            $table->boolean('action')->default(0);
            $table->boolean('skidka')->default(0);
            $table->boolean('hit')->default(0);
            $table->integer('postav_id')->default(0);
            $table->integer('part_id')->default(0);
            $table->boolean('zakaz')->default(0);
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
