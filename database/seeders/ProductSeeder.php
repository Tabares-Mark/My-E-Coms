<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Existing products
        Product::create([
            'name' => 'RCB A2 Series',
            'price' => 1300,
            'quantity' => 10,
            'category' => 'Motor Parts',
            'description' => 'White and Silver Rear shock absorber',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'Samsung Galaxy S23',
            'price' => 60000,
            'quantity' => 20,
            'category' => 'Smart Phone',
            'description' => 'Latest Samsung smartphone with 128GB storage.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'Asus ROG Strix G15',
            'price' => 85000,
            'quantity' => 15,
            'category' => 'Laptop',
            'description' => 'Gaming laptop with high-performance specs.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        // New products
        Product::create([
            'name' => 'Yamaha YZF-R3',
            'price' => 250000,
            'quantity' => 5,
            'category' => 'Motorcycle',
            'description' => 'Sport bike with a powerful engine and sleek design.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'Honda CB500F',
            'price' => 400000,
            'quantity' => 7,
            'category' => 'Motorcycle',
            'description' => 'Naked bike with a comfortable riding position.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'NVIDIA GeForce RTX 3080',
            'price' => 65000,
            'quantity' => 10,
            'category' => 'Computer Accessory',
            'description' => 'High-performance graphics card for gaming and rendering.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'Corsair Vengeance LPX 16GB',
            'price' => 4500,
            'quantity' => 25,
            'category' => 'Computer Accessory',
            'description' => 'High-speed RAM for gaming and multitasking.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'Logitech G502 Hero',
            'price' => 3000,
            'quantity' => 30,
            'category' => 'Computer Accessory',
            'description' => 'High-performance gaming mouse with customizable buttons.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'HP Pavilion 15',
            'price' => 55000,
            'quantity' => 8,
            'category' => 'Laptop',
            'description' => 'Affordable laptop for everyday use.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'Apple iPhone 14',
            'price' => 80000,
            'quantity' => 15,
            'category' => 'Smart Phone',
            'description' => 'Latest Apple smartphone with advanced camera features.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'Razer Kraken X',
            'price' => 4000,
            'quantity' => 20,
            'category' => 'Computer Accessory',
            'description' => 'Lightweight gaming headset with great sound quality.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'Dell XPS 13',
            'price' => 95000,
            'quantity' => 6,
            'category' => 'Laptop',
            'description' => 'Premium ultrabook with high-resolution display.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'Google Pixel 7',
            'price' => 50000,
            'quantity' => 10,
            'category' => 'Smart Phone',
            'description' => 'Smartphone with excellent camera capabilities.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'Lenovo IdeaPad 3',
            'price' => 35000,
            'quantity' => 12,
            'category' => 'Laptop',
            'description' => 'Affordable laptop for students and professionals.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'Acer Predator Helios 300',
            'price' => 75000,
            'quantity' => 5,
            'category' => 'Laptop',
            'description' => 'Gaming laptop with powerful graphics and cooling.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'Sony WH-1000XM4',
            'price' => 12000,
            'quantity' => 15,
            'category' => 'Computer Accessory',
            'description' => 'Noise-canceling wireless headphones.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'OnePlus 10 Pro',
            'price' => 70000,
            'quantity' => 10,
            'category' => 'Smart Phone',
            'description' => 'High-end smartphone with fast charging.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'Bose QuietComfort 35 II',
            'price' => 15000,
            'quantity' => 10,
            'category' => 'Computer Accessory',
            'description' => 'Wireless noise-canceling headphones.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'Fujifilm Instax Mini 11',
            'price' => 6000,
            'quantity' => 8,
            'category' => 'Camera',
            'description' => 'Instant camera for capturing memories.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'Nikon D3500',
            'price' => 45000,
            'quantity' => 4,
            'category' => 'Camera',
            'description' => 'Entry-level DSLR camera for photography enthusiasts.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);

        Product::create([
            'name' => 'Motorola Moto G Power',
            'price' => 20000,
            'quantity' => 12,
            'category' => 'Smart Phone',
            'description' => 'Budget smartphone with long battery life.',
            'barcode' => $this->generateUniqueBarcode(),
        ]);
    }

    private function generateUniqueBarcode()
    {
        return strtoupper(uniqid('BAR_')); 
    }
}
