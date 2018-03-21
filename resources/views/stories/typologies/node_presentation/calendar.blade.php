<?php
$maxDate = $story->textNodes()->max('created_at');
$minDate = $story->textNodes()->min('created_at');

$day_num=date("j"); //If today is September 29, $day_num=29
$month_num = date("m"); //If today is September 29, $month_num=9
$year = date("Y"); //4-digit year
$date_today = getdate(mktime(0,0,0,$month_num,1,$year)); //Returns array of date info for 1st day of this month
$month_name = $date_today["month"]; //Example: "September" - to label the Calendar
$first_week_day = $date_today["wday"]; //"wday" is 0-6, 0 being Sunday. This is for day 1 of this month

//Refer to PHP: getdate – Manual for more information on this function.
//Next we are going to figure out which day is the FINAL day of the month.
$cont = true;
$today = 27; //The last day of the month must be >27, so start here
while (($today <= 32) && ($cont)) //At 32, we have to be rolling over to the next month
{
//Iterate through, incrementing $today
//Get the date information for the (hypothetical) date $month_num/$today/$year
$date_today = getdate(mktime(0,0,0,$month_num,$today,$year));
//Once $date_today's month ($date_today["mon"]) rolls over to the next month, we've found the $lastday
if ($date_today["mon"] != $month_num)
{
$lastday = $today - 1; //If we just rolled over to the next month, need to subtract 1 to get our $lastday
$cont = false; //This kicks us out of the while loop
}
$today++;
}
?>
<div class="fondo-forms">
    <div class="container">
      <div class="row leer-palabras">
        <div class="col-md-12">

          <div class="nodo-data-relato">
              <div class="image-clip">
                @if($story->cover != null && !empty($story->cover))
                    <img alt="@lang('tapa de') {{$story->title}}" src="{{ asset('imagenes/cover/'.$story->cover )}}"> @else
                    <img alt="" src="{{ asset('img/img-relato-default.jpg')}}">
                @endif
              </div>
              <p class="tit-relato">{{$story->title}}</p>
              <p class="autor-relato">{{$story->getAuthorName()}}</p>
          </div>

          <div class="container-nodo">
          <table summary="Lista de nodos del relato">

              <caption class="tit-mes">{{$month_name}}</caption>
              <thead>
                <tr>
                  <th scope="col">Lun</th>
                  <th scope="col">Mar</th>
                  <th scope="col">Mie</th>
                  <th scope="col">Jue</th>
                  <th scope="col">Vie</th>
                  <th scope="col">Sab</th>
                  <th scope="col">Dom</th>
                </tr>
              </thead>
              <tbody>
          <?php
          $day = 1; //This variable will track the day of the month
          $wday = $first_week_day; //This variable will track the day of the week (0-6, with Sunday being 0)
          $firstweek = true; //Initialize $firstweek variable so we can deal with it first
          ?>
          @while ( $day <= $lastday) {{-- Iterate through all days of the month  --}}
            @if ($firstweek) {{--Special case - first week (remember we initialized $first_week_day above)--}}
            <tr>
              @for ($i=1; $i<=$first_week_day; $i++)
              <td> </td>{{-- //Put a blank cell for each day until you hit $first_week_day --}}
              @endfor
              @php $firstweek = false; //Great, we're done with the blank cells @endphp
            @endif

            @if ($wday==0) {{-- //Start a new row every Sunday --}}
              <tr align=left>
            @endif
            <td>@if($day==$day_num)<a href="#" class="dia">{{$day}}</a>@else {{$day}} @endif</td>
            @if ($wday==6)
          </tr> {{-- //If today is Saturday, close this row --}}
            @endif
          @php
          $wday++; //Increment $wday
          $wday = $wday % 7; //Make sure $wday stays between 0 and 6 (so when $wday++ == 7, this will take it back to 0)
          $day++; //Increment $day
          @endphp
          @endwhile


          @while($wday <=6 ) {{-- //Until we get through Saturday --}}
           {{-- <td> </td>//Output an empty cell --}}
          @php $wday++; @endphp
          @endwhile
          </tr>
          </tbody>
          </table>
          <div class="botones-nav-form">
            <a href="#" class="bot ant">Mayo</a>
            <a href="#" class="bot sig">Junio</a>
          </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  @include('textNodes.backdrop-calendar')
