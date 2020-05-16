<?php

namespace App\Http\Controllers;

use App\Constitute;
use App\Chapter;
use Illuminate\Http\Request;

class ConstitutionController extends Controller
{
    public function index()
    {
      return Chapter::where('id','>', 0)->get();
    }

    public function quiz($chapter_id)
    {
      return Constitute::where('chapter_id',$chapter_id)->get();
    }
}
