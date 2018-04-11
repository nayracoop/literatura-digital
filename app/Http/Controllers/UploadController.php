<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as R;
use App\Models\Story;
use App\Models\TextNode;
use App\Http\Requests\UploadPicture;

class UploadController extends Controller
{
    /**
    * storePictureXhr
    * Guarda foto y si existe la asocia al relato
    */
    public function storeCoverPictureXhr(UploadPicture $request, $story = null)
    {
        $cover = '';
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $cover = date('Y/m/dHis') . '.' . $request->cover->extension();
            $path = $request->cover->storeAs('', $cover, 'nayra');
        }
        if ($story != null) {
            $s = Story::where('_id', $story)->orWhere('slug', $story)->first();
            $s->cover = $cover;
            $s->save();
        }

        return response()->json([
            'picUrl' => url('imagenes/cover/' . $cover),
            'picName' => $cover
        ]);
    }


    /**
    * storeTextNodePictureXhr
    * Guarda foto de un nodo y devuelve la ruta para ser usada en src de img
    */
    public function storeTextNodePictureXhr(UploadPicture $request)
    {
        $cover = '';
        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            $picture = date('Y/m/dHis') . '.' . $request->picture->extension();
            $path = $request->picture->storeAs('', $picture, 'nayra');
        }


        return response()->json([
          //  'picUrl' => url('/' . $picture),
            'imgNode' => route('imagecache', ['original', $picture])
        ]);
    }

}
