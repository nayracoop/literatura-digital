<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request as R;

class TypologyController extends Controller
{
    public function description($typology)
    {
        return view('description')
            ->with('typology', $typology);
    }
}
