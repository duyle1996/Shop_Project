<?php
use App\Category;
use App\Comment;
use App\Order;
use App\OrderItem;
use App\Product;
use App\Rating;
use App\User;
use Faker\Generator as Faker;

//use Illuminate\Foundation\Auth\User;

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

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => str_random(10),
        'parent_id' => 0,
    ];
});
$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => Category::all()->random()->id,
        'name' => $faker->name,
        'description' => $faker->text,
        'price' => $faker->numberBetween($min = 10, $max = 30),
        'picture' => $faker->image(),
        'unit' => $faker->randomDigit(),
        'unit_in_stock' => $faker->numberBetween($min = 10, $max = 20),
        'unit_on_order' => $faker->numberBetween($min = 30, $max = 50),

    ];
});
$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'role' => $faker->randomElement([
            'administrator',
            'user',
        ]),
        'password' => $faker->password(),
        'picture' => $faker->image(),
        'phone' => $faker->phoneNumber(),
        'address' => $faker->address(),

    ];
});
$factory->define(Order::class, function (Faker $faker) {
    return [
        'token' => str_random(10),
        'user_id' => User::all()->random()->id,
        'total' => $faker->numberBetween($min = 1000, $max = 2000),
        'status' => $faker->randomElement([
            'stocking', 'out of stock',
        ]),
        'order_name' => $faker->name,
        'order_address' => $faker->secondaryAddress,
        'order_phone' => $faker->phoneNumber,

    ];
});

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        'order_id' => Order::all()->random()->id,
        'product_id' => Product::all()->random()->id,
        'quantity' => $faker->numberBetween($min = 10, $max = 20),
        'price' => $faker->randomNumber(2),
        'total' => $faker->numberBetween($min = 500, $max = 700),

    ];
});
$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'product_id' => Product::all()->random()->id,
        'content' => $faker->catchPhrase,
        'picture' => $faker->image(),

    ];
});
$factory->define(Rating::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'product_id' => Product::all()->random()->id,
        'rating' => $faker->randomElement([
            '1', '2', '3', '4', '5',
        ]),

    ];
});
