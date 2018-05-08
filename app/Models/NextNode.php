<?php

namespace App\Models;

use Moloquent;
use Carbon\Carbon;
//use App\Models\BaseModel;
//use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class NextNode extends Moloquent
{
//  use SoftDeletes;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = [
      'nodeId', 'nodeTitle', 'label'
   ];
}
