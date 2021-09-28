<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends Component
{


    use WithPagination;
    public $category, $subcategoryh, $brandh;

    public $view = 'grid';

    protected $queryString = [
        'subcategoryh','brandh'
    ];

    public function resetFilter()
    {
        $this->reset(['subcategoryh','brandh','page']);
        
    }
    public function updatedBrandh()
    {
        $this->resetPage();
    }
    public function updatedSubcategoryh()
    {
        $this->resetPage();
    }

    public function render()
    {
        $productsQuery = Product::query()->whereHas('subcategory.category', function(Builder $query){
         
            $query->where('id',$this->category->id);
        });

        if(!empty($this->subcategoryh)){
            $productsQuery = $productsQuery->whereHas('subcategory', function(Builder $query){
                $query->where('slug',$this->subcategoryh);
            });
        }
        if(!empty($this->brandh)){
            $productsQuery = $productsQuery->whereHas('brand', function(Builder $query){
                $query->where('name',$this->brandh);
            });
        }

        $products = $productsQuery->with([
            'images'
        ])->paginate(20);
        
        return view('livewire.category-filter', compact('products'));
    }
}
