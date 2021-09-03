<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /* Invoke se usa cuando va a ser un unico método, laravel entiende que invoke es como index sin tener que llamarlo  */
    /* Se lo llama de forma normal sin aclarar el método: Route::get('search', [SearchController::class])->name('search'); */
    public function __invoke(Request $request)
    {
        $name = $request->name;

        $posts = Post::where('name', 'LIKE', "%" . $name . "%")
                         ->where('status', 3)
                         ->paginate(8);
                         
        return view('search', compact('posts'));
    }
}
