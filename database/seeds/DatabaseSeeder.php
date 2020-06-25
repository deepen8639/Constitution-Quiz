<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
          ConstitutesTableSeeder::class,
          ChaptersTableSeeder::class,
          UsersTableSeeder::class,
          CrossUseridCustomquizzesTableSeeder::class,
          CustomQuizzesTableSeeder::class,
        ]);
    }
}
