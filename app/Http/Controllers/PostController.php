<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use App\Models\Subcategory;
use App\Models\Tag;
use Illuminate\Http\Request;

/* INFO: TRABAJO CON CACHE PARA CONSULTAS/QUERIES COMPLEJAS https://youtu.be/Nmq3lmgi_Sk?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=193 */
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index()
    {
        /* Este mensaje flash se muestra a través de jetstren y el componente está en app.blade.php */
        if(auth()->user()){

            $pendiente = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();
            if($pendiente){
                $mensaje = "Usted tiene $pendiente ordenes pendientes. <a class='font-bold' href='" . route('orders.index') . "?status=1'>Ir a pagar</a>";
                session()->flash('flash.banner', $mensaje);
            }

        }        

        $posts = Post::where('status', 2)->latest()->paginate(8);
        /* La siguiente consulta: 
        $posts = Post::where('status', 2)->latest()->paginate(8);
        Se cambia por la siguiente funcionalidad para trabajar la CACHE
        */


        /* CACHE: La funcionalidad de la cache es guardar la consulta en cache y mostrar desde la memoria la respuesta al usuario/vista.
           de esta manera evitamos consumir recursos en el servidor y agilizar la respuesta.
           Si no está almacenado en cache lo guardamos en cache y de ahí en más siempre va a mostrar la respuesta desde la cache 
        */
        /* INFO: TRABAJO CON CACHE PARA CONSULTAS/QUERIES 
        COMPLEJAS https://youtu.be/Nmq3lmgi_Sk?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=193 */

        /* Verificamos si estamos pasando la cache de la pagina, por ejemplo al verificar esto la 
        paginacion va a refrescar la cache con los cambios de paginate */

        /* if (request()->page) { */
        
            /* Almacenamos posts con la informacion de la pagina */

            /* $key = 'posts' . request()->page;
        } else { */

            /* Si no sólo la variable key con posts */

           /*  $key = 'posts';
        } */

        /* Preguntamos si almacenamos en cache la información de los posts por ejemplo 
        $key es la variable de la funcion de arriba que verifica si estamos en una paginacion*/

        /* if (Cache::has($key)) { */

            /* Si tenemos en cache la consulta de posts recuperamos esa consulta */

            /* $posts = Cache::get($key);
        } else { */

            /* Si no tengo almacenado en cache la consulta hacemos la consulta normal*/

            /* $posts = Post::where('status', 2)->latest()->paginate(8); */

            /* Luego debemos almacenar en cache la consulta anterior */

            /* Cache::put($key, $posts);
        } */

        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        /* Si un usuario quiere cambiar el id en la vista show del post podría acceder un post en estado borrador
        para evitar eso creamos el policy published
        INFO: https://youtu.be/Ar2y-J30Bao?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=556 */
        $this->authorize('published', $post);

        $similares = Post::where('subcategory_id', $post->subcategory_id)
                            ->where('status', 2)
                            ->where('id', '!=', $post->id)
                            ->latest('id')
                            ->take(4)
                            ->get();

        return view('posts.show', compact('post', 'similares'));
    }

    public function category(Category $category)
    {
        $posts = $category->posts()->where('status', 2)
                        ->latest('id')
                        ->get();
        
        return view('posts.category', compact('posts', 'category'));
        
    }

    public function subcategory(Subcategory $subcategory)
    {
        /* $posts = $subcategory->category->posts->where('status', 2); */
        $posts =  $subcategory->posts()->where('status', 2)->latest('id')->paginate(6);
        return view('posts.subcategory', compact('posts', 'subcategory'));
        
    }

    public function tag(Tag $tag)
    {
        $posts =  $tag->posts()->where('status', 2)->latest('id')->paginate(6);

        return view('posts.tag', compact('posts', 'tag'));

    }
}
