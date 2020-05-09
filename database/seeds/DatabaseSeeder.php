<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Disable all tables foreign keys
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // Truncate all tables data [ Empty all tables]
        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        // Set the quantity of each table elements
        $userQuantity = 200;
        $categoryQuantity = 30;
        $productQuantity = 1000;
        $transactionQuantity = 200;
      
        // Set the factories
        factory(User::class, $userQuantity)->create();
        factory(Category::class, $categoryQuantity)->create();
        factory(Product::class, $productQuantity)->create()->each(
            function($product){
                // Get couple of cateogries only the id
                $categories = Category::all()->random(mt_rand(1,5))->pluck('id');

                // Atttach the category with the product
                $product->categories()->attach($categories);
        });

        factory(Transaction::class,$transactionQuantity)->create();

    }
}
