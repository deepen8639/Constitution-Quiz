<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCorrectnessDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (Schema::hasTable('user_correctness_data')) {
        // テーブルが存在していればリターン
        return;
        }
        Schema::create('user_correctness_data', function (Blueprint $table) {
            $table->string('user_id');//主キー
            $table->integer('wrong_1')->default(0);
            $table->integer('wrong_2')->default(0);
            $table->integer('wrong_3')->default(0);
            $table->integer('wrong_4')->default(0);
            $table->integer('wrong_5')->default(0);
            $table->integer('wrong_6')->default(0);
            $table->integer('wrong_7')->default(0);
            $table->integer('wrong_8')->default(0);
            $table->integer('wrong_9')->default(0);
            $table->integer('wrong_10')->default(0);
            $table->integer('wrong_11')->default(0);
            $table->integer('wrong_12')->default(0);
            $table->integer('wrong_13')->default(0);
            $table->integer('wrong_14')->default(0);
            $table->integer('wrong_15')->default(0);
            $table->integer('wrong_16')->default(0);
            $table->integer('wrong_17')->default(0);
            $table->integer('wrong_18')->default(0);
            $table->integer('wrong_19')->default(0);
            $table->integer('wrong_20')->default(0);
            $table->integer('wrong_21')->default(0);
            $table->integer('wrong_22')->default(0);
            $table->integer('wrong_23')->default(0);
            $table->integer('wrong_24')->default(0);
            $table->integer('wrong_25')->default(0);
            $table->integer('wrong_26')->default(0);
            $table->integer('wrong_27')->default(0);
            $table->integer('wrong_28')->default(0);
            $table->integer('wrong_29')->default(0);
            $table->integer('wrong_30')->default(0);
            $table->integer('wrong_31')->default(0);
            $table->integer('wrong_32')->default(0);
            $table->integer('wrong_33')->default(0);
            $table->integer('wrong_34')->default(0);
            $table->integer('wrong_35')->default(0);
            $table->integer('wrong_36')->default(0);
            $table->integer('wrong_37')->default(0);
            $table->integer('wrong_38')->default(0);
            $table->integer('wrong_39')->default(0);
            $table->integer('wrong_40')->default(0);
            $table->integer('wrong_41')->default(0);
            $table->integer('wrong_42')->default(0);
            $table->integer('wrong_43')->default(0);
            $table->integer('wrong_44')->default(0);
            $table->integer('wrong_45')->default(0);
            $table->integer('wrong_46')->default(0);
            $table->integer('wrong_47')->default(0);
            $table->integer('wrong_48')->default(0);
            $table->integer('wrong_49')->default(0);
            $table->integer('wrong_50')->default(0);
            $table->integer('wrong_51')->default(0);
            $table->integer('wrong_52')->default(0);
            $table->integer('wrong_53')->default(0);
            $table->integer('wrong_54')->default(0);
            $table->integer('wrong_55')->default(0);
            $table->integer('wrong_56')->default(0);
            $table->integer('wrong_57')->default(0);
            $table->integer('wrong_58')->default(0);
            $table->integer('wrong_59')->default(0);
            $table->integer('wrong_60')->default(0);
            $table->integer('wrong_61')->default(0);
            $table->integer('wrong_62')->default(0);
            $table->integer('wrong_63')->default(0);
            $table->integer('wrong_64')->default(0);
            $table->integer('wrong_65')->default(0);
            $table->integer('wrong_66')->default(0);
            $table->integer('wrong_67')->default(0);
            $table->integer('wrong_68')->default(0);
            $table->integer('wrong_69')->default(0);
            $table->integer('wrong_70')->default(0);
            $table->integer('wrong_71')->default(0);
            $table->integer('wrong_72')->default(0);
            $table->integer('wrong_73')->default(0);
            $table->integer('wrong_74')->default(0);
            $table->integer('wrong_75')->default(0);
            $table->integer('wrong_76')->default(0);
            $table->integer('wrong_77')->default(0);
            $table->integer('wrong_78')->default(0);
            $table->integer('wrong_79')->default(0);
            $table->integer('wrong_80')->default(0);
            $table->integer('wrong_81')->default(0);
            $table->integer('wrong_82')->default(0);
            $table->integer('wrong_83')->default(0);
            $table->integer('wrong_84')->default(0);
            $table->integer('wrong_85')->default(0);
            $table->integer('wrong_86')->default(0);
            $table->integer('wrong_87')->default(0);
            $table->integer('wrong_88')->default(0);
            $table->integer('wrong_89')->default(0);
            $table->integer('wrong_90')->default(0);
            $table->integer('wrong_91')->default(0);
            $table->integer('wrong_92')->default(0);
            $table->integer('wrong_93')->default(0);
            $table->integer('wrong_94')->default(0);
            $table->integer('wrong_95')->default(0);
            $table->integer('wrong_96')->default(0);
            $table->integer('wrong_97')->default(0);
            $table->integer('wrong_98')->default(0);
            $table->integer('wrong_99')->default(0);
            $table->integer('wrong_100')->default(0);
            $table->integer('wrong_101')->default(0);
            $table->integer('wrong_102')->default(0);
            $table->integer('wrong_103')->default(0);

            $table->integer('correct_1')->default(0);
            $table->integer('correct_2')->default(0);
            $table->integer('correct_3')->default(0);
            $table->integer('correct_4')->default(0);
            $table->integer('correct_5')->default(0);
            $table->integer('correct_6')->default(0);
            $table->integer('correct_7')->default(0);
            $table->integer('correct_8')->default(0);
            $table->integer('correct_9')->default(0);
            $table->integer('correct_10')->default(0);
            $table->integer('correct_11')->default(0);
            $table->integer('correct_12')->default(0);
            $table->integer('correct_13')->default(0);
            $table->integer('correct_14')->default(0);
            $table->integer('correct_15')->default(0);
            $table->integer('correct_16')->default(0);
            $table->integer('correct_17')->default(0);
            $table->integer('correct_18')->default(0);
            $table->integer('correct_19')->default(0);
            $table->integer('correct_20')->default(0);
            $table->integer('correct_21')->default(0);
            $table->integer('correct_22')->default(0);
            $table->integer('correct_23')->default(0);
            $table->integer('correct_24')->default(0);
            $table->integer('correct_25')->default(0);
            $table->integer('correct_26')->default(0);
            $table->integer('correct_27')->default(0);
            $table->integer('correct_28')->default(0);
            $table->integer('correct_29')->default(0);
            $table->integer('correct_30')->default(0);
            $table->integer('correct_31')->default(0);
            $table->integer('correct_32')->default(0);
            $table->integer('correct_33')->default(0);
            $table->integer('correct_34')->default(0);
            $table->integer('correct_35')->default(0);
            $table->integer('correct_36')->default(0);
            $table->integer('correct_37')->default(0);
            $table->integer('correct_38')->default(0);
            $table->integer('correct_39')->default(0);
            $table->integer('correct_40')->default(0);
            $table->integer('correct_41')->default(0);
            $table->integer('correct_42')->default(0);
            $table->integer('correct_43')->default(0);
            $table->integer('correct_44')->default(0);
            $table->integer('correct_45')->default(0);
            $table->integer('correct_46')->default(0);
            $table->integer('correct_47')->default(0);
            $table->integer('correct_48')->default(0);
            $table->integer('correct_49')->default(0);
            $table->integer('correct_50')->default(0);
            $table->integer('correct_51')->default(0);
            $table->integer('correct_52')->default(0);
            $table->integer('correct_53')->default(0);
            $table->integer('correct_54')->default(0);
            $table->integer('correct_55')->default(0);
            $table->integer('correct_56')->default(0);
            $table->integer('correct_57')->default(0);
            $table->integer('correct_58')->default(0);
            $table->integer('correct_59')->default(0);
            $table->integer('correct_60')->default(0);
            $table->integer('correct_61')->default(0);
            $table->integer('correct_62')->default(0);
            $table->integer('correct_63')->default(0);
            $table->integer('correct_64')->default(0);
            $table->integer('correct_65')->default(0);
            $table->integer('correct_66')->default(0);
            $table->integer('correct_67')->default(0);
            $table->integer('correct_68')->default(0);
            $table->integer('correct_69')->default(0);
            $table->integer('correct_70')->default(0);
            $table->integer('correct_71')->default(0);
            $table->integer('correct_72')->default(0);
            $table->integer('correct_73')->default(0);
            $table->integer('correct_74')->default(0);
            $table->integer('correct_75')->default(0);
            $table->integer('correct_76')->default(0);
            $table->integer('correct_77')->default(0);
            $table->integer('correct_78')->default(0);
            $table->integer('correct_79')->default(0);
            $table->integer('correct_80')->default(0);
            $table->integer('correct_81')->default(0);
            $table->integer('correct_82')->default(0);
            $table->integer('correct_83')->default(0);
            $table->integer('correct_84')->default(0);
            $table->integer('correct_85')->default(0);
            $table->integer('correct_86')->default(0);
            $table->integer('correct_87')->default(0);
            $table->integer('correct_88')->default(0);
            $table->integer('correct_89')->default(0);
            $table->integer('correct_90')->default(0);
            $table->integer('correct_91')->default(0);
            $table->integer('correct_92')->default(0);
            $table->integer('correct_93')->default(0);
            $table->integer('correct_94')->default(0);
            $table->integer('correct_95')->default(0);
            $table->integer('correct_96')->default(0);
            $table->integer('correct_97')->default(0);
            $table->integer('correct_98')->default(0);
            $table->integer('correct_99')->default(0);
            $table->integer('correct_100')->default(0);
            $table->integer('correct_101')->default(0);
            $table->integer('correct_102')->default(0);
            $table->integer('correct_103')->default(0);
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_correctness_data');
    }
}