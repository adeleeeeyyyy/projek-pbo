<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Skincare', 'Makeup', 'Haircare', 'Fragrance', 'Body Care'];
        $beautyImages = [
            'https://images.unsplash.com/photo-1556228720-195a672e8a03?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1596462502278-27bfdc4033c8?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1612817288484-6f916006741a?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1556228578-0d85ec1a4a4b?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1594465919760-441fe5908ab0?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1567721913486-6585f069b332?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1556229010-6c3f2c9ca5f8?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1583241800698-e8ab01c85b27?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1616683693504-3ea7e9ad6fec?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1515377905703-c4788e51af15?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1608248597279-f99d160bfcbc?q=80&w=600&auto=format&fit=crop'
        ];

        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->randomFloat(2, 50000, 1500000),
            'image_url' => $this->faker->randomElement($beautyImages),
            'stock' => $this->faker->numberBetween(0, 100),
            'category' => $this->faker->randomElement($categories),
        ];
    }
}
