<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id('post_id');
            $table->bigInteger('user_id')->unsigned();
            $table->integer('sub_category_id')->unsigned();
            $table->string('post_title');
            $table->longText('post_detail');
            $table->char('is_active', 1);
            $table->char('is_seller', 1);
            $table->char('is_individual', 1);
            $table->float('expected_price');
            $table->char('is_price_negotiable', 1);
            $table->date('last_renewed_on');
            $table->string('locality');
            $table->string('city');
            $table->string('state',30);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
