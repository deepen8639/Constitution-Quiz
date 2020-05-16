<?php

namespace App\Http\Controllers;

use App\Constitute;
use App\Chapter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConstituteController extends Controller
{
  public function index()
  {
    $chapters = Chapter::all();
    return view('constitute',['chapters'=>$chapters]);
  }

  public function quiz($id)
  {

  }
}
