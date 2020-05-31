<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrossUseridCustomquizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (Schema::hasTable('cross_userid_customquizzes')) {
        // テーブルが存在していればリターン
        return;
        }
        Schema::create('cross_userid_customquizzes', function (Blueprint $table) {
            $table->Increments('custom_quize_id')->unsigned();;
            $table->string('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
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
        Schema::dropIfExists('cross_userid_customquizzes');
    }
}
