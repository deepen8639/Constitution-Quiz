<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Constitute;
use Illuminate\Http\Request;

class InputController extends Controller
{

  public function index()
  {
    return view('input');
  }
    public function inputConstitution()
    {
      $constitutions = Constitute::all();
      if (10 < count($constitutions)) {
        return view('input',['message_constitution' => 'constitution data input already done']);

      }
      $content = file('../storage/app/Constitution_Data.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      $con = array();
      // $index = 0;
      for ($i=0; $i < 103; $i++) {
        $con[$i] = array();
      }
      $caption =array();
      $title = array();
      $blank = array();
      $choices = array();
      $provision = array();

      for ($i=0; $i < count($content); $i++) {
        $c = $content[$i];
        $ind = mb_substr($c,0,2);//最初の二文字を切り出す
        if ($ind == 'in') {
          $id = $content[$i+1];
          $id = explode(",", $id);
          $con[(int)$id[0]]['id'] = (int)$id[0];

          $c_next = $content[$i+2];
          $c_next = explode("'", $c_next);
          $provision[] = $c_next[1];
        }
        elseif ($ind == "'〔") {
          $c = explode("'", $c);
          $caption[] = $c[1];
        }
        elseif ($ind == "'第") {
          $c = explode("'", $c);
          $title[] = $c[1];

          $c_next = $content[$i+1];
          $c_next = explode("'", $c_next);
          $blank[] = $c_next[1];

          $c_third = $content[$i+2];
          $c_third = explode("'", $c_third);
          $c_third = explode(",", $c_third[1]);
          $choices[] = $c_third;
        }
      }

      array_splice($con,0,1);

      for ($i=0; $i < count($con); $i++) {
          $con[$i]['provision'] = $provision[$i];
          $con[$i]['title'] = $title[$i];
          $con[$i]['caption'] = $caption[$i];
          $con[$i]['blank'] = $blank[$i];
          $con[$i]['choice_1'] = $choices[$i][0];
          $con[$i]['choice_2'] = $choices[$i][1];
          $con[$i]['choice_3'] = $choices[$i][2];
          if (1 <= $con[$i]['id'] and $con[$i]['id'] <= 8) {
            $con[$i]['chapter_id'] = 1;
          }elseif ($con[$i]['id'] == 9) {
            $con[$i]['chapter_id'] = 2;
          }elseif (10 <= $con[$i]['id'] and $con[$i]['id'] <= 40) {
            $con[$i]['chapter_id'] = 3;
          }elseif (41 <= $con[$i]['id'] and $con[$i]['id'] <= 64) {
            $con[$i]['chapter_id'] = 4;
          }elseif (65 <= $con[$i]['id'] and $con[$i]['id'] <= 75) {
            $con[$i]['chapter_id'] = 5;
          }elseif (76 <= $con[$i]['id'] and $con[$i]['id'] <= 82) {
            $con[$i]['chapter_id'] = 6;
          }elseif (83 <= $con[$i]['id'] and $con[$i]['id'] <= 91) {
            $con[$i]['chapter_id'] = 7;
          }elseif (92 <= $con[$i]['id'] and $con[$i]['id'] <= 95) {
            $con[$i]['chapter_id'] = 8;
          }elseif (96 <= $con[$i]['id'] and $con[$i]['id'] <= 96) {
            $con[$i]['chapter_id'] = 9;
          }elseif (97 <= $con[$i]['id'] and $con[$i]['id'] <= 99) {
            $con[$i]['chapter_id'] = 10;
          }elseif (100 <= $con[$i]['id'] and $con[$i]['id'] <= 103) {
            $con[$i]['chapter_id'] = 11;
          }
      }


      foreach ($con as $c) {
        $constitution = Constitute::create(['id' => $c['id'],'title' => $c['title'],'caption' => $c['caption'],
      'provision' => $c['provision'], 'blank' => $c['blank'],'choice_1' => $c['choice_1'], 'choice_2' => $c['choice_2'],
    'choice_3' => $c['choice_3'], 'chapter_id' => $c['chapter_id']]);
        // $constitution = Constitute::create(['title' => $c['title']]);
        // $constitution = Constitute::create(['caption' => $c['caption']]);
        // $constitution = Constitute::create(['provision' => $c['provision']]);
        // $constitution = Constitute::create(['blank' => $c['blank']]);
        // $constitution = Constitute::create(['choice_1' => $c['choice_1']]);
        // $constitution = Constitute::create(['choice_2' => $c['choice_2']]);
        // $constitution = Constitute::create(['choice_3' => $c['choice_3']]);

      }

    return view('input',['message_constitution' => 'successfully done!!']);

    }

    public function inputChapter(){

      $chapters = Chapter::all();
      if (1<count($chapters)) {
        return view('input',['message_chapter' => 'chapter data input already done']);
      }
      $content = file('../storage/app/Chapter_Data.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
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

      return view('input',['message_chapter' => 'successfully done!!']);

    }
}
