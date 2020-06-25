<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\CustomQuizzes;

class CustomQuizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      CustomQuizzes::create(["custom_quize_id" => 1, "provision_id" => 3]);
      CustomQuizzes::create(["custom_quize_id" => 1, "provision_id" => 5]);
      CustomQuizzes::create(["custom_quize_id" => 1, "provision_id" => 10]);
      CustomQuizzes::create(["custom_quize_id" => 2, "provision_id" => 34]);
      CustomQuizzes::create(["custom_quize_id" => 2, "provision_id" => 35]);
      CustomQuizzes::create(["custom_quize_id" => 2, "provision_id" => 36]);
      CustomQuizzes::create(["custom_quize_id" => 2, "provision_id" => 37]);
      CustomQuizzes::create(["custom_quize_id" => 2, "provision_id" => 99]);
      CustomQuizzes::create(["custom_quize_id" => 2, "provision_id" => 100]);
    }
}
