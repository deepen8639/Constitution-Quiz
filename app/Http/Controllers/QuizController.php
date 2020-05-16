<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Constitute;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function ChapterQuiz(Request $request){
      for ($i=1; $i < 12; $i++) {
        $chapter_id_array[] = (string)$i;
      }

      $chapter_id = $request->chapter_id;
      if ($chapter_id == null or !in_array($chapter_id, $chapter_id_array)) {
        $chapter = Chapter::all();//constituteに戻る
        return view('constitute',['chapters' => $chapter]);
      }
      $provision_data = Constitute::where('chapter_id', (int)$chapter_id)->get();


      return view('quiz',compact($provision_data));
      // return view('quiz',['chapter_id' => $chapter_id]);
    }
}
