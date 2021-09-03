<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Ventanas',
                'slug' => Str::slug('Ventanas'),
                'icon' => '<i class="far fa-window-restore"></i>'
            ],
            [
                'name' => 'Puertas',
                'slug' => Str::slug('Puertas'),
                'icon' => '<i class="fas fa-door-closed"></i>'
            ],
            [
                'name' => 'Portones',
                'slug' => Str::slug('Portones'),
                'icon' => '<i class="fas fa-torii-gate"></i>'
            ],
            [
                'name' => 'Toldos',
                'slug' => Str::slug('Toldos'),
                'icon' => '<i class="fas fa-umbrella-beach"></i>'
            ],
            [
                'name' => 'Accesorios',
                'slug' => Str::slug('Accesorios'),
                'icon' => '<i class="fas fa-tools"></i>'
            ],
        ];

        foreach ($categories as $category ) {
            $category= Category::Factory(1)->create($category)->first();

            $brands = Brand::factory(4)->create();
            foreach ($brands as $brand ) {
                $brand->categories()->attach($category->id);
            }
        }
    }
}
