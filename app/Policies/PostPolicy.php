<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    
    use HandlesAuthorization;

    /* Con este policy verificamos que el usuario sólo pueda editar, actualizar o eliminar sus post
    Ya que de lo contrario el usuario podría entrar por ejemplo a edit y cambiar el id del post */
    /* INFO DE FUNCIONAMIENTO DE POLICY: https://youtu.be/Ar2y-J30Bao?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=146 */
    public function author(User $user, Post $post)
    {
        /* Si el id del usuario registrado coincide con el usuario que creo el post  */
        if($user->id == $post->user_id){
            return true;
        }else{
            return false;
        }
    }

    /* Si un usuario quiere cambiar el id en la vista show del post podría acceder un post en estado borrador
        para evitar eso creamos el policy published
        INFO: https://youtu.be/Ar2y-J30Bao?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=556 */
        
        /* El simbolo de interrogación antes del model ?User indica que esa validación es opcional,
        basicamente si no lo ponemos ? el sistema no deja ver los post a usuarios no autentificados 
        INFO: https://youtu.be/Ar2y-J30Bao?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=672*/

    public function published(?User $user, Post $post)
    {
            if($post->status == 3){
                return true;
            }else{
                return false;
            }
    }

    /* https://www.udemy.com/course/aprende-a-crear-una-plataforma-de-cursos-con-laravel/learn/lecture/24518068#notes */
    /* Policy para no volver a poder crear una reseña */
    public function valued(User $user, Post $post)
    {
        if (Review::where('user_id', $user->id)->where('post_id', $post->id)->count()) {
            return false;
        }else{
            return true;
        }
    }

    public function revision(User $user, Post $post)
    {
        if($post->status == 2){
            return true;
        }else{
            return false;
        }
    }
}
