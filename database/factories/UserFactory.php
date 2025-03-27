<?php
namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'email_verified_at' => now(),
            'role' => 'vendor',
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $vendor) {
            $storesImages = [
                'store_images/store1.jpg',
                'store_images/store2.jpg',
                'store_images/store3.jpg',
            ];

            $itemsImages = [
                'product_images/item1.jpg',
                'product_images/item2.jpg',
                'product_images/item3.jpg',
                'product_images/item4.jpg',
            ];

            // Create Store
            $store = Store::create([
                'vendor_id' => $vendor->id,
                'name' => fake()->company(),
                'description' => fake()->sentence(),
                'image' => $storesImages[array_rand($storesImages)],
            ]);

            if (fake()->boolean(60)) {
                $category = Category::create([
                    'store_id' => $store->id,
                    'name' => fake()->word(),
                ]);
            } else {
                $category = null;
            }

            // Create Products
            for ($i = 0; $i < 15; $i++) {
                Product::create([
                    'store_id' => $store->id,
                    'category_id' => $category?->id,
                    'name' => fake()->word(),
                    'description' => fake()->sentence(),
                    'price' => fake()->randomFloat(2, 10, 500),
                    'stock_quantity' => fake()->numberBetween(10, 500),
                    'image' => $itemsImages[array_rand($itemsImages)],
                ]);
            }
        });
    }
}

