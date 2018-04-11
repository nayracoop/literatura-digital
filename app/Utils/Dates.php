<?php
namespace App\Utils;

use Carbon\Carbon;
use View;

class Dates
{
    public static function renderCalendar($story, $month, $year)
    {
        $nodes = $story->textNodesByDate($month, $year);
        return View::make('utils.calendar.month')
          ->with('nodesByDate', $nodes)
          ->with('month', $month)
          ->with('year', $year)
          ->with('story', $story)
          ->render();
    }

    public static function getDateFromInput($input)
    {
        $day = null;
        $month = null;
        $year = null;
        $hour = null;
        $minute = null;

        if ($input['dia'] != null) {
            $day = $input['dia'];
        }
        if ($input['mes'] != null) {
            $month = $input['mes'];
        }
        if ($input['anio'] != null) {
            $year = $input['anio'];
        }
        if ($input['hora'] != null) {
            $hour = $input['hora'];
        }
        if ($input['minutos'] != null) {
            $minute = $input['minutos'];
        }

        //dia mes anio hora minuto segundo
        return Carbon::create($year, $month, $day, $hour, $minute, 0);
    }
}
