<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories = [
            // Ventanas
            [
                'category_id' => 1,
                'name' => 'linea 1',
                'slug' => Str::slug('linea 1'),
                'color' => true,
                'size' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'linea 2',
                'slug' => Str::slug('linea 2'),
                'color' => true,
                'size' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'linea 3',
                'slug' => Str::slug('linea 3'),
                'color' => false,
                'size' => true,
            ],
            //puertas
            [
                'category_id' => 2,
                'name' => 'linea 1',
                'slug' => Str::slug('linea 1'),
                'color' => true,
                'size' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'linea 2',
                'slug' => Str::slug('linea 2'),
                'color' => false,
                'size' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'linea 3',
                'slug' => Str::slug('linea 3'),
                'color' => true,
                'size' => true,
            ],
            //portones
            [
                'category_id' => 3,
                'name' => 'linea 1',
                'slug' => Str::slug('linea 1'),
                'color' => true,
                'size' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'linea 2',
                'slug' => Str::slug('linea 2'),
                'color' => false,
                'size' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'linea 3',
                'slug' => Str::slug('linea 3'),
                'color' => true,
                'size' => true,
            ],
            //toldos
            [
                'category_id' => 4,
                'name' => 'linea 1',
                'slug' => Str::slug('linea 1'),
                'color' => false,
                'size' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'linea 2',
                'slug' => Str::slug('linea 2'),
                'color' => true,
                'size' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'linea 3',
                'slug' => Str::slug('linea 3'),
                'color' => true,
                'size' => true,
            ],
            // accesorios
            [
                'category_id' => 5,
                'name' => 'accesorios toldos',
                'slug' => Str::slug('accesorios toldos'),
                'color' => true,
                
            ],
            [
                'category_id' => 5,
                'name' => 'accesorios ventanas',
                'slug' => Str::slug('accesorios ventanas'),
                'color' => false,
            ],
            [
                'category_id' => 5,
                'name' => 'accesorios puertas',
                'slug' => Str::slug('accesorios puertas'),
                'color' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'accesorios portones',
                'slug' => Str::slug('accesorios portones'),
                'color' => true,
            ],
        ];

        foreach ($subcategories as $subcategory) {
            Subcategory::Factory(1)->create($subcategory);
       
        }

    }
}
