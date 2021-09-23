<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Subcategory;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        $subcategory_id = $product->subcategory_id;

        $subcategory = Subcategory::find($subcategory_id);

        if ($subcategory->size) {
            if ($product->colors->count()) {
                $product->colors()->detach();
            }
        } elseif ($subcategory->color) {
            if ($product->sizes->count()) {
                foreach ($product->sizes as $size) {
                    $size->delete();
                }
            }
        } else {
            if ($product->colors->count()) {
                $product->colors()->detach();
            }
            if ($product->sizes->count()) {
                foreach ($product->sizes as $size) {
                    $size->delete();
                }
            }
        }
        $product->quantity = null;
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
