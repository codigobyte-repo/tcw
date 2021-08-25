<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    
    
    /* INFORMACION DE USO: https://youtu.be/fsjq3bGxs9s?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=590 */



    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function creating(Post $post)
    {
        /*  Aquí necesitamos pasar al controlador el id del usuario autenticado, dado que desde la vista a través del inspector de elemento se podría
        cambiar el ID y publicar un post como otro usuario, llevamos esta funcionalidad a un observer. PostObserver
        INFO: https://youtu.be/fsjq3bGxs9s?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=881  */

        /* Al ejecutar la migration desde consola da un error dado que los posts se crean con el factory, 
        para evitar el error hacemos lo siguiente. INFO: https://youtu.be/fsjq3bGxs9s?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=1048 */
        if(! \App::runningInConsole()){
            $post->user_id = auth()->user()->id;
        }
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleting(Post $post)
    {
        if($post->image){
            Storage::delete($post->image->url);
        }
    }
}
