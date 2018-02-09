<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent')->default(0);
            $table->boolean('publish')->default(0);
            $table->string('title');
            $table->string('title_ua')->nullable();
            $table->string('menu_title')->nullable();
            $table->string('menu_title_ua')->nullable();
            $table->string('slug');
            $table->integer('order')->default(0);
            $table->string('code_1c')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('main_categories');
    }
}
