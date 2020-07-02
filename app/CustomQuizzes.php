<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomQuizzes extends Model
{
    protected $fillable = [
      'custom_quize_id',
      'provision_id',
    ];
}
