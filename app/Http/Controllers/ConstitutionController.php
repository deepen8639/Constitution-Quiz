<?php

namespace App\Http\Controllers;

use App\Constitute;
use App\Chapter;
use Illuminate\Http\Request;

class ConstitutionController extends Controller
{
    public function returnChapter()
    {
      $all_chapter = Chapter::where('id','>', 0)->get();
      //データの整形
      $return_data = array();
      foreach ($all_chapter as $chapter) {
        $return_data[$chapter->id] = $chapter;
      }
      return $return_data;
    }

    public function returnProvision()
    {
      $all_provision = Constitute::all();
      //データの整形
      $return_data = array();
      foreach ($all_provision as $provision) {
        $return_data[$provision->chapter_id][] = $provision;
      }
      // $result = ksort($return_data);
      return $return_data;
    }

    public function quiz($chapter_id)
    {
      return Constitute::where('chapter_id',$chapter_id)->get();
    }
}
