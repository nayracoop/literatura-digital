<?php

namespace App\Models;

use App\Models\BaseModel;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Lang;
use Auth;

class History extends BaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function historyNodes()
    {
        return $this->embedsMany('\App\Models\HistoryNode');
    }

    public function isNodeRead($nodeId)
    {
        return $this->historyNodes->find($nodeId) !== null ? true : false;
    }
}
