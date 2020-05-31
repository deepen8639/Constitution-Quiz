<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomQuizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       if (Schema::hasTable('custom_quizzes')) {
         // テーブルが存在していればリターン
         return;
         }
         Schema::create('custom_quizzes', function (Blueprint $table) {
             $table->Increments('p_id');//代理キー
             $table->integer('custom_quize_id')->unsigned();
             $table->integer('provision_id');
             $table->foreign('provision_id')->references('id')->on('constitutes');
             $table->foreign('custom_quize_id')->references('custom_quize_id')->on('cross_userid_customquizzes');
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
         Schema::dropIfExists('custom_quizzes');
     }
}
