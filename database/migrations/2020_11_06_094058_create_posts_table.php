<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->id()->autoIncrement();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('sub_category_id')->nullable()->constrained();
            $table->string('post_title')->nullable();
            $table->longText('post_detail')->nullable();
            $table->enum('status', ['ACTIVE', 'PENDING', 'REJECTED'])->default('PENDING');
            $table->enum('ad_type', ['PERSONAL', 'BUSINESS'])->nullable();
            $table->float('expected_price')->nullable();
            $table->enum('is_price_negotiable', ['YES', 'NO'])->nullable();
            $table->timestamp('last_renewed_on')->nullable();
            $table->string('locality')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 30)->nullable();
            $table->softDeletes();
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
