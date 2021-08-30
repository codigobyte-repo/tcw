<?php

namespace App\Http\Livewire\Publisher;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Post;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CreatePosts extends Component
{
    use WithFileUploads;
 
    public $photo;
    
    public $categories, $subcategories = [], $brands = [];
    public $category_id = "", $subcategory_id = "", $brand_id = "";
    public $name, $slug, $description, $tiempo_entrega, $price;
    public $commission = 8;

    protected $rules = [
        'category_id' => 'required',
        'subcategory_id' => 'required',
        'name' => 'required',
        'slug' => 'required|unique:posts',
        'description' => 'required',
        'brand_id' => 'required',
        'tiempo_entrega' => 'required',
        'price' => 'required'
    ];

    protected $validationAttributes = [
        'category_id' => 'categoría',
        'subcategory_id' => 'subcategoría',
        'name' => 'nombre',
        'slug' => 'slug',
        'description' => 'descripción',

        'brand_id' => 'marca',
        'tiempo_entrega' => 'tiempo de entrega',
        'price' => 'precio',
        'photo' => 'imagen',
    ];

    public function updatedCategoryId($value){
        $this->subcategories = Subcategory::where('category_id', $value)->get();

        /* WhereHas filtra colecciones */
        /* INFO: https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26961140#notes */
        $this->brands = Brand::whereHas('categories', function(Builder $query) use ($value){
            $query->where('category_id', $value);
        })->get();

        $this->reset(['subcategory_id', 'brand_id']);
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function mount()
    {
        $this->categories = Category::all();   
    }

    public function save()
    {
        $this->validate();

        if($this->photo){
            $this->rules['photo'] = 'image';
        }

        $post = new Post();
        $post->name = $this->name;
        $post->slug = $this->slug;
        $post->description = $this->description;
        $post->tiempo_entrega = $this->tiempo_entrega;
        
        $post->price = $this->price;
        $post->commission = $this->commission;
        $post->fee = $this->price * $this->commission / 100;
        $post->price_total = $this->price * $this->commission / 100 + $this->price;

        $post->status = 1;

        $post->user_id = auth()->user()->id;
        $post->subcategory_id = $this->subcategory_id;
        $post->brand_id = $this->brand_id;

        /* Creamos el post */
        $post->save();

        if($this->photo){
            $url = $this->photo->store('public/posts');
            $post->images()->create([
                'url' => $url
            ]);
        }        

        return redirect()->route('publisher.index');
  
    }

    public function render()
    {
        return view('livewire.publisher.create-posts')->layout('layouts.publisher');
    }
}
