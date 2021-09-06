<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('subcategories');
        Storage::deleteDirectory('categories');
        Storage::deleteDirectory('products');

        Storage::makeDirectory('subcategories');
        Storage::makeDirectory('categories');
        Storage::makeDirectory('products');

        

        $this->call(UserSeeder::class);

        $this->call(CategorySeeder::class);
        $this->call(SubcategorySeeder::class);

        $this->call(ProductSeeder::class);

        $this->call(ColorSeeder::class);
        $this->call(ColoProductSeeder::class);

        $this->call(SizeSeeder::class);
        $this->call(ColorSizeSeeder::class);
    }
}
