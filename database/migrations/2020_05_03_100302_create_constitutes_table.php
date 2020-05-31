<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstitutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (Schema::hasTable('constitutes')) {
        // テーブルが存在していればリターン
        return;
      }
      Schema::create('constitutes', function (Blueprint $table) {
          $table->integer('id')->unique();
          $table->text('provision');
          $table->string('caption',50)->nullable();
          $table->string('title',25)->nullable();
          $table->string('blank',25)->nullable();
          $table->string('choice_1',25)->nullable();
          $table->string('choice_2',25)->nullable();
          $table->string('choice_3',25)->nullable();
          $table->integer('chapter_id');
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
      Schema::dropIfExists('constitutes');

    }
}
