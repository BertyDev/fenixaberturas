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

    public function resetFilter()
    {
        $this->reset(['subcategoryh','brandh']);
    }

    public function render()
    {
        // $products = $this->category->products()
                    
        //             ->where('status',2)->paginate(20);

        $productsQuery = Product::query()->whereHas('subcategory.category', function(Builder $query){
         $query->where('id',$this->category->id);
        });

        if(!empty($this->subcategoryh)){
            $productsQuery = $productsQuery->whereHas('subcategory', function(Builder $query){
                $query->where('name',$this->subcategoryh);
            });
        }
        if(!empty($this->brandh)){
            $productsQuery = $productsQuery->whereHas('brand', function(Builder $query){
                $query->where('name',$this->brandh);
            });
        }

        $products = $productsQuery->with(['images'])->paginate(20);
        
        return view('livewire.category-filter', compact('products'));
    }
}
