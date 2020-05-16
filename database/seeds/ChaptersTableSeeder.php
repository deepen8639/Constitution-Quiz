<?php


use App\Chapter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $chapters = Chapter::all();
      if (1<count($chapters)) {
        return;
      }
      $content = file('storage/app/Chapter_Data.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      // var_dump($content);

      $id = array();
      $number = array();
      $name = array();

      for ($i=0; $i < count($content); $i++) {
        if (preg_match('/id/', $content[$i])) {
            $c = $content[$i];
            $c = explode(',', $c);
            $c = explode('>', $c[0]);
            $id[] = (int)$c[1];
        }
        elseif (preg_match('/number/', $content[$i])) {
            $c = $content[$i];
            $c = explode(',', $c);
            $c = explode('>', $c[0]);
            $c = explode("'", $c[1]);
            $number[] = $c[1];
          }
        elseif (preg_match('/name/', $content[$i])) {
            $c = $content[$i];
            $c = explode('>', $c);
            $c = explode("'", $c[1]);
            $name[] = $c[1];
          }
      }

      $chapter = array();
      for ($i=0; $i < count($id); $i++) {
        $chapter[$i]['id'] = $id[$i];
        $chapter[$i]['number'] = $number[$i];
        $chapter[$i]['name'] = $name[$i];
      }


      foreach ($chapter as $c) {
        $chap = Chapter::create(['id' => $c['id'], 'number' => $c['number'], 'name' => $c['name']]);

      }

      return;

    }

}
