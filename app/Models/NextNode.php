<?php

namespace App\Models;

use Moloquent;
use Carbon\Carbon;

class NextNode extends Moloquent
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = [
      'nodeId', 'nodeTitle', 'label'
   ];
}
