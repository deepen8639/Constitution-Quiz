<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\CrossUseridCustomquiz;

class CrossUseridCustomquizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CrossUseridCustomquiz::create(["user_id" => 'honda']);
        CrossUseridCustomquiz::create(["user_id" => 'honda']);
    }
}
