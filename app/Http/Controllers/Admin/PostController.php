<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Subcategory;
use App\Models\Tag;
use App\Policies\PostPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.create')->only('create', 'store');
        $this->middleware('can:admin.posts.edit')->only('edit', 'update');
        $this->middleware('can:admin.posts.destroy')->only('destroy');
    }

    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        /* si le pesamos el método all() devuelve un objeto y laravel collective necesita un array
        por eso le pasamos Category::pluck('name', 'id'); name que devuelve el array unicamente con los campos name y id el id*/
        $categories = Category::pluck('name', 'id');
        
        $subcategories = Category::with('subcategory')->get();
        

        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags', 'subcategories'));
    }

    public function store(PostRequest $request)
    {
        /* StorePostRequest EXPLICACIÓN: https://youtu.be/4up37JqWhC8?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=486 */
        /* Si status es igual a 1 utiliza x reglas si no utiliza otras x reglas*/

        $post = Post::create($request->all());

        /* Como guardar la imagen con la relación image() https://youtu.be/bTT3uIfYN90?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=1615 */
        if($request->file('file')){
            $url = Storage::put('public/posts', $request->file('file'));

            $post->image()->create([
                'url' => $url
            ]);
        }

        /* CACHE: INFOhttps://youtu.be/4efitwAOhio?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=108
           Para usar la cache para mostrar los posts, también al momento de CREAR un posts debemos borrar la cache
           si no lo que sucede es que no aparece el post dado que en la cache no se actualiza
        */
        Cache::flush();

        if($request->tags){
            /* Para guardar los atgs relación muchos a muchos hacemos $post->tags() para indicar la relación de las etiquetas 
            con el post y luego usamos attach para traer con $request->tags todas las etiquetas seleccionadas en el form
            EXPLICACIÓN: https://youtu.be/4up37JqWhC8?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=1245
            */
            $post->tags()->attach($request->tags);
        }
        
        if($request->subcategory){
            $post->subcategories()->attach($request->subcategory);
        }

        return redirect()->route('admin.posts.edit', $post)->with('info', 'El post se creó con éxito'); 
    }

    public function edit(Post $post)
    {
        /* Si un usuario va a editar y en la url cambia el ID por otro puede editar otro post.
        Para evitarlo usamos la POLICY PostPolicy.php
        INFO: https://youtu.be/Ar2y-J30Bao?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=267 */
        $this->authorize('author', $post);

        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();

        /* Obtenemos el id de la categoria del post a editar */
        $category_id = $post->subcategory->category->id;

        /* Obtenemos las subcategorias relacionadas con la categoria*/
        $subcategories = Subcategory::where('category_id', $category_id)->pluck('name', 'id');
        

        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'subcategories'));
    }

    public function update(PostRequest $request, Post $post)
    {

        $this->authorize('author', $post);

        $post->update($request->all());

        /* Actualizar imagen: https://youtu.be/uy5rQJWP9mg?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=1248 */
        if($request->file('file')){
            $url = Storage::put('public/posts', $request->file('file'));

            if($post->image){
                Storage::delete($post->image->url);

                $post->image->update([
                    'url' => $url
                ]);
            }else{
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        /* CACHE: INFOhttps://youtu.be/4efitwAOhio?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=108
           Para usar la cache para mostrar los posts, también al momento de CREAR un posts debemos borrar la cache
           si no lo que sucede es que no aparece el post dado que en la cache no se actualiza
        */
        Cache::flush();

        return redirect()->route('admin.posts.edit', $post)->with('info', 'El post se actulizó con éxito');
    }

    public function destroy(Post $post)
    {
        $this->authorize('author', $post);
        /* Para eliminar la imagen usamos un observer INFO: https://youtu.be/fsjq3bGxs9s?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=463 */
        $post->delete();

        /* CACHE: INFOhttps://youtu.be/4efitwAOhio?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=108
           Para usar la cache para mostrar los posts, también al momento de CREAR un posts debemos borrar la cache
           si no lo que sucede es que no aparece el post dado que en la cache no se actualiza
        */
        Cache::flush();

        return redirect()->route('admin.posts.index')->with('info', 'El post se eliminó con éxito');
    }

    /* INFO: https://youtu.be/mYVl4lUadcs */
    public function getSubCategories(Request $request, $id)
    {
        if($request->ajax()){
            $subcategories = Subcategory::where('category_id', $id)->get();
            return response()->json($subcategories);
        }
    }

}
