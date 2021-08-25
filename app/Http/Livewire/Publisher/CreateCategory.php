<?php

namespace App\Http\Livewire\Publisher;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CreateCategory extends Component
{

    use WithFileUploads;

    public $brands, $categories, $category, $rand;

    protected $listeners = ['delete'];

    /* Creamos un array para guardar los datos del formulario */
    /* https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/27331092#notes */
    public $createForm = [
        'name' => null,
        'slug' => null,
        'icon' => null,
        'image' => null,
        'brands' => []
    ];

    public $editForm = [
        'open' => false,
        'name' => null,
        'slug' => null,
        'icon' => null,
        'image' => null,
        'brands' => []
    ];

    public $editImage;

    protected $rules = [
        'createForm.name' => 'required',
        'createForm.slug' => 'required|unique:categories,slug',
        'createForm.icon' => 'required',
        'createForm.image' => 'required|image|max:1024',
        'createForm.brands' => 'required'
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'createForm.slug' => 'slug',
        'createForm.icon' => 'ícono',
        'createForm.image' => 'imagen',
        'createForm.brands' => 'marca',

        'editForm.name' => 'nombre',
        'editForm.slug' => 'slug',
        'editForm.icon' => 'ícono',
        'editImage' => 'imagen',
        'editForm.brands' => 'marca'
    ];

    public function mount()
    {
        $this->getBrands();
        $this->getCategories();
        $this->rand = rand();
    }

    public function updatedCreateFormName($value)
    {
        $this->createForm['slug'] = Str::slug($value);
    }

    public function updatedEditFormName($value)
    {
        $this->editForm['slug'] = Str::slug($value);
    }

    public function getBrands()
    {
        $this->brands = Brand::all();
    }

    public function render()
    {
        return view('livewire.publisher.create-category');
    }

    public function getCategories()
    {
        $this->categories = Category::all();
    }

    public function save()
    {
        $this->validate();
        /* Esto da error pero funciona bien, no lo detecta visual code */
        $image = $this->createForm['image']->store('public/categories');
        
        $category = Category::create([
            'name' => $this->createForm['name'],
            'slug' => $this->createForm['slug'],
            'icon' => $this->createForm['icon'],
            'image' => $image
        ]);

        $category->brands()->attach($this->createForm['brands']);
        /* Con este valor random que le agregamos al input de image sirve que al cargar la categoría se limpie el campo */
        /* INFO https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/27332822?start=315#notes */
        $this->rand = rand();

        $this->reset('createForm');

        $this->getCategories();

        $this->emit('saved');
    }

    public function edit(Category $category)
    {

        $this->reset(['editImage']);
        $this->resetValidation();

        /* INFO EDIT: https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/27396714#questions */
        $this->category = $category;
        
        $this->editForm['open'] = true;
        $this->editForm['name'] = $category->name;
        $this->editForm['slug'] = $category->slug;
        $this->editForm['icon'] = $category->icon;
        $this->editForm['image'] = $category->image;
        $this->editForm['brands'] = $category->brands->pluck('id');
    }

    public function update()
    {

        $rules = [
            'editForm.name' => 'required',
            'editForm.slug' => 'required|unique:categories,slug,' . $this->category->id,
            'editForm.icon' => 'required',
            'editForm.brands' => 'required'
        ];

        if($this->editImage){
            $rules['editImage'] = 'image|max:1024';
        }

        $this->validate($rules);

        if($this->editImage){
            /* Eliminamos la imagen antigua */
            Storage::delete($this->editForm['image']);
            $this->editForm['image'] = $this->editImage->store('public/categories');
        }

        $this->category->update($this->editForm);

        $this->category->brands()->sync($this->editForm['brands']);

        $this->reset(['editForm', 'editImage']);

        $this->getCategories();

    }

    public function delete(Category $category)
    {
        $category->delete();
        $this->getCategories();
    }
}
