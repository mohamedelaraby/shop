<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Seller;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'verified' =>$verified = $faker->randomElement([User::VERIFIED_USER,User::UNVERIFIED_USER]),
        'verification_token' =>$verified == User::VERIFIED_USER ? null : User::generateVerificationCode(0),
        'admin' =>$verified =$faker->randomElement([User::ADMIN_USER,User::REGULAR_USER]),
    ];
});


// Categories factory
$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
    ];
});


// Categories factory
$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity'=> $faker->numberBetween(1,10),
        'status'=>$faker->randomElement([Product::AVAILABE_PRODUCT,Product::UNAVAILABLE_PRODUCT]),
        'image' =>$faker->randomElement(['1.jpg','2.jpg','3.jpg']),
        'seller_id'=>User::all()->random()->id,
    ];
});

// Transactions factory
$factory->define(Transaction::class, function (Faker $faker) {
	// GEt th seller and the buyer
	$seller = Seller::has('products')->get()->random();
	$buyer = User::all()->except($seller->id)->random();
    return [
        'quantity'=> $faker->numberBetween(1,3),
        'buyer_id'=>$buyer->id,
        'product_id'=>$seller->products->random()->id,
    ];
});