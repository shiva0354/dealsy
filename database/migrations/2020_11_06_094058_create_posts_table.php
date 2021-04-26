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
            $table->string('title')->nullable();
            $table->text('detail')->nullable();
            $table->enum('status', ['ACTIVE', 'PENDING', 'REJECTED', 'SOLD'])->default('PENDING');
            $table->float('price')->nullable();
            $table->timestamp('last_renewed_on')->nullable();
            $table->string('locality')->nullable();
            $table->foreignId('city')->nullable()->constrained('locations');
            $table->foreignId('state')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::update("ALTER TABLE posts AUTO_INCREMENT = 1000000001");
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
