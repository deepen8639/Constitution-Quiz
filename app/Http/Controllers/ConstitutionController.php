<?php

namespace App\Http\Controllers;

use App\Constitute;
use App\Chapter;
use Illuminate\Http\Request;

class ConstitutionController extends Controller
{
    public function returnChapter()
    {
      return Chapter::where('id','>', 0)->get();
    }

    public function returnProvision()
    {
      return Constitute::all();
    }

    public function quiz($chapter_id)
    {
      return Constitute::where('chapter_id',$chapter_id)->get();
    }
}
