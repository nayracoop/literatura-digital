<?php
namespace App\Utils;

use Carbon\Carbon;
use View;

class Ergodic
{
    public static function renderNode($story, $node)
    {
          return View::make('utils.ergodic.node')
          ->with('node', $node)
          ->with('story', $story)
          ->render();
    }
}
