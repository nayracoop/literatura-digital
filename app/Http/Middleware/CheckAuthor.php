<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Story;
use App\Models\Enums\UserType;
use Auth;
use Flash;

class CheckAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * usage: ->middleware('auth.author')
     */
    public function handle($request, Closure $next)
    {
        $isNew = $request->has('story') ? $request->story :true;
      //  $id = $request->has('id') ? $request->id : $request->story;
        if (!$isNew) {
            $story = Story::where('_id', $id)->orWhere('slug', $request->story)->first();
            $user = Auth::user();
            if ($user->role !== UserType::ADMIN &&  $story->author_id !== $user->id) {
            //  abort(403, 'Unauthorized action.');
             //se podria mensage flash
                return redirect()->route('index');
            }
        }


      //  var_dump($id);
        return $next($request);
    }
}
