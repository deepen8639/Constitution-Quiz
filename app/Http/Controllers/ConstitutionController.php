<?php

namespace App\Http\Controllers;

use App\Constitute;
use App\Chapter;
use App\CustomQuizzes;
use App\CrossUseridCustomquiz;
use App\UserCorrectnessData;
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
      return $return_data;
    }

    public function returnUserCustomQuiz($user_id)
    {
      $all_cross_userid_customquiz = CrossUseridCustomquiz::where('user_id', '=', $user_id)->get();
      $return_data = array();
      foreach ($all_cross_userid_customquiz as $cross_userid_customquiz) {
        // code...
        $return_data[$cross_userid_customquiz->custom_quize_id] = CustomQuizzes::where('custom_quize_id', '=', $cross_userid_customquiz->custom_quize_id)->get();
      }

      return $return_data;
    }

    public function returnUserCorrectness($user_id)
    {
      $user_correctness = UserCorrectnessData::where('user_id', $user_id)->get()->all();
      if (isset($user_correctness[0]->user_id)) {
        return $user_correctness[0];
      } else {
        UserCorrectnessData::create(['user_id' => $user_id]);
        $user_correctness = UserCorrectnessData::where('user_id', $user_id)->get()->all();
        return $user_correctness[0];
      }
    }//returnUserCorrectness()

    public function updateUserCorrectness(Request $request)
    {
      $user_id = $request->user_id;
      $wrong_provision = $request->wrong_provision;
      $correct_provision  = $request->correct_provision;
      try {
        $user_correctness = UserCorrectnessData::where('user_id', $user_id)->get()->all()[0];
          $debug_return = [];
          // return $debug_return = [isset($wrong_provision)];
          if (isset($wrong_provision)) {

            foreach ($wrong_provision as $w_p) {

              $wrong_id = 'wrong_' . (string)$w_p['id'];
              $wrong_id_value = $user_correctness->$wrong_id;
              $wrong_id_value += 1;
              $user_correctness->where("user_id", $user_id)->update([$wrong_id => $wrong_id_value]);
            }
          }
          if (isset($correct_provision)) {

            foreach ($correct_provision as $c_p) {
              $correct_id = 'correct_' . (string)$c_p['id'];
              $correct_id_value = $user_correctness->$correct_id;
              $correct_id_value += 1;
              $user_correctness->where("user_id", $user_id)->update([$correct_id => $correct_id_value]);
            }
          }
          $user_correctness = UserCorrectnessData::where('user_id', $user_id)->get()->all()[0];
          return $user_correctness;

      } catch (\Exception $e) {
        return $e;
      }
    }//updateUserCorrectness()


}
