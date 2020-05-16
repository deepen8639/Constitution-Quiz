<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constitute extends Model
{
  protected $fillable = [
          'id',
          'provision',
          'caption',
          'title',
          'blank',
          'choice_1',
          'choice_2',
          'choice_3',
          'chapter_id'
      ];
}
