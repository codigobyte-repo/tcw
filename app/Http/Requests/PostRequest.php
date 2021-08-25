<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /* En el form create hay un input hidden con el id del usuario
        en este punto validamos que el usuario no haya cambiado en el inspector de elementos 
        su id para publicar como otra persona
        https://youtu.be/4up37JqWhC8?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=934 */
        
        return true;

        /* if($this->user_id == auth()->user()->id){
            return true;
        }else{
            return false;
        } */
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        /* La validación para el update debe permitir usar el mismo slug que ya teniamos en el momento de editar para que no permita usar 
        el mismo slug hacemos lo siguiente.
        INFORMACION: https://youtu.be/uy5rQJWP9mg?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=815
         */
        $post = $this->route()->parameter('post');

        /* EXPLICACIÓN: https://youtu.be/4up37JqWhC8?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=486 */
        /* Si status es igual a 1 utiliza las siguientes reglas */
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts',
            /* Status es requerido y sólo puede tomar el valor de 1 o de 2 */
            'status' => 'required|in:1,2',
            'file' => 'image'
        ];

        if($post){
            $rules['slug'] = 'required|unique:posts,slug,' . $post->id;
        }

        /* Si status es igual a 2 utiliza las siguientes reglas junto a las reglas 1 por eso se mershea $rules $rules = array_merge();*/
        if($this->status == 2){
            $rules = array_merge($rules, [
                'category_id' => 'required',
                'tags' => 'required',
                'extract' => 'required',
                'body' => 'required',
            ]);
        }

        return $rules;
    }
}
