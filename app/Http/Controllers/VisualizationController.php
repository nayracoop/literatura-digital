<?php
namespace App\Http\Controllers;

use App\Models\Typology;
use Illuminate\Support\Facades\Request as R;
use Illuminate\Support\Facades\Input;

class VisualizationController extends Controller
{
    public function getByTypologyId()
    {
        $typology_id = Input::get('typology_id');
        $typology = Typology::find($typology_id);
        $visualizations = $typology->visualizations;

        if (R::ajax()) {
            return response()->json([ 'visualizations' => $visualizations ]);
        }
    }
}
