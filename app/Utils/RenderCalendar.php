<?php
namespace App\Utils;

use View;

class RenderCalendar
{
    private $nodesByDate;


    public static function render($nodes, $month, $year) {
      return View::make('utils.calendar.month')
          ->with('nodesByDate', $nodes)
          ->with('month_num', $month)
          ->with('year', $year)
        //  ->with('title', $search)
          ->render();
    }

}
