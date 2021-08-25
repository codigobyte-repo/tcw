<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $categories = Category::all();
        $brands = Brand::paginate(6);
        return view('livewire.footer', compact('categories','brands'));
    }
}
