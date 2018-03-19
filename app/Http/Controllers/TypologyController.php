<?php
namespace App\Http\Controllers;

class TypologyController extends Controller
{
    public function description($typology)
    {
        return view('description')
            ->with('typology', $typology);
    }
}
