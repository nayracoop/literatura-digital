<?php
namespace App\Utils;

use View;

class RenderCalendar
{
    public static function render($story, $month, $year)
    {
        $nodes = $story->textNodesByDate($month, $year);
        return View::make('utils.calendar.month')
          ->with('nodesByDate', $nodes)
          ->with('month', $month)
          ->with('year', $year)
          ->with('story', $story)
          ->render();
    }
}
