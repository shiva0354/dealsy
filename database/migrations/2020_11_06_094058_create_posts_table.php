<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->id()->autoIncrement();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('sub_category_id')->nullable();
            $table->string('post_title')->nullable();
            $table->longText('post_detail')->nullable();
            $table->char('is_active', 1);
            $table->char('is_seller', 1);
            $table->char('is_individual', 1);
            $table->float('expected_price')->nullable();
            $table->char('is_price_negotiable', 1);
            $table->timestamp('last_renewed_on')->nullable();
            $table->string('locality')->nullable();
            $table->string('city')->nullable();
            $table->string('state',30)->nullable();
            $table->timestamps();
        });

        DB::update("ALTER TABLE posts AUTO_INCREMENT = 1000000000;");
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
