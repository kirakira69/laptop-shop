<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create an Admin User (So you can login immediately)
        // Password is 'password' by default in Laravel factories
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@laptopshop.com',
            'password' => bcrypt('password'), // Sets password to 'password'
            'is_admin' => true, 
        ]);

        // 2. Create Categories
        $gaming = Category::create(['name' => 'Gaming', 'slug' => 'gaming']);
        $ultrabook = Category::create(['name' => 'Ultrabook', 'slug' => 'ultrabook']);
        $business = Category::create(['name' => 'Business', 'slug' => 'business']);

        // 3. Create 5 Example Laptops
        
        // Laptop 1: High-End Gaming
        // Laptop 1: High-End Gaming
        Product::create([
            'category_id' => $gaming->id,
            'name' => 'ASUS ROG Zephyrus G14',
            'slug' => 'asus-rog-zephyrus-g14',
            'description' => 'The world\'s most powerful 14-inch gaming laptop.',
            'price' => 1599.99,
            'stock' => 10,
            'image' => 'products/g14.jpg', // <--- CHANGED THIS
            'is_active' => true,
        ]);

        // Laptop 2: Premium Business
        Product::create([
            'category_id' => $business->id,
            'name' => 'Lenovo ThinkPad X1 Carbon',
            'slug' => 'lenovo-thinkpad-x1',
            'description' => 'Ultralight, ultrathin, and ultra-powerful.',
            'price' => 1899.50,
            'stock' => 5,
            'image' => 'products/x1.jpg', // <--- CHANGED THIS
            'is_active' => true,
        ]);

        // Laptop 3: Sleek Ultrabook
        Product::create([
            'category_id' => $ultrabook->id,
            'name' => 'Dell XPS 13 Plus',
            'slug' => 'dell-xps-13-plus',
            'description' => 'Twice as powerful as before in the same size.',
            'price' => 1349.00,
            'stock' => 8,
            'image' => 'products/xps.jpg', // <--- CHANGED THIS
            'is_active' => true,
        ]);

        // Laptop 4: Budget Gaming
        Product::create([
            'category_id' => $gaming->id,
            'name' => 'Acer Nitro 5',
            'slug' => 'acer-nitro-5',
            'description' => 'Reign over the game world.',
            'price' => 899.99,
            'stock' => 20,
            'image' => 'products/nitro.jpg', // <--- CHANGED THIS
            'is_active' => true,
        ]);

        // Laptop 5: Creator/Student
        Product::create([
            'category_id' => $ultrabook->id,
            'name' => 'Apple MacBook Air M2',
            'slug' => 'macbook-air-m2',
            'description' => 'Strikingly thin and fast.',
            'price' => 1199.00,
            'stock' => 15,
            'image' => 'products/macbook.jpg', // <--- CHANGED THIS
            'is_active' => true,
        ]);
    }
}