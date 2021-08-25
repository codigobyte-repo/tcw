<?php

namespace App\Http\Livewire\Publisher;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EditPost extends Component
{
    public $post, $categories, $subcategories, $brands, $slug;

    public $category_id;

    protected $rules = [
        'category_id' => 'required',
        'post.subcategory_id' => 'required',
        'post.name' => 'required',
        'post.slug' => 'required|unique:posts,slug',
        'post.description' => 'required',
        'post.brand_id' => 'required',
        'post.tiempo_entrega' => 'required',
        'post.price' => 'required',
    ];

    protected $listeners = ['refreshPost', 'delete'];

    public function refreshPost()
    {
        /* basicamente a través de un oyente refrescamos la pagina con fresh */
        $this->post = $this->post->fresh();
    }

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->categories = Category::all();
        $this->category_id = $post->subcategory->category->id;
        $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
        $this->slug = $this->post->slug;

        $this->brands = Brand::whereHas('categories', function(Builder $query){
            $query->where('category_id', $this->category_id);
        })->get();
    }

    public function updatedPostName($value)
    {
        $this->post->slug = Str::slug($value);
    }

    public function updatedCategoryId($value){
        $this->subcategories = Subcategory::where('category_id', $value)->get();

        $this->brands = Brand::whereHas('categories', function(Builder $query) use ($value){
            $query->where('category_id', $value);
        })->get();

        $this->post->subcategory_id = "";
        $this->post->brand_id = "";
    }

    public function save()
    {
        $rules = $this->rules;
        $rules['post.slug'] = 'required|unique:posts,slug,' . $this->post->id;
 
        $this->validate($rules);
 
        $this->post->slug = $this->slug;
 
        $this->post->save();
 
        $this->emit('saved');
    }

    public function deleteImage(Image $image)
    {
        Storage::delete([$image->url]);
        $image->delete();

        $this->post = $this->post->fresh();
    }

    public function delete(){
        
        $images = $this->post->images;
        
        foreach ($images as $image) {
            Storage::delete($image->url);
            $image->delete();
        }

        $this->post->delete();

        return redirect()->route('publisher.index');
    }

    public function render()
    {
        return view('livewire.publisher.edit-post')->layout('layouts.publisher');
    }
}
