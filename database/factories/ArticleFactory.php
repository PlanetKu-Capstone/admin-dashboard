<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2, 8)),
            'slug' => $this->faker->slug(),
            'description' => collect($this->faker->paragraphs(mt_rand(3,10)))
                        ->map(fn($p)=> "<p>$p</p>")
                        ->implode(''),
            'excerpt' => $this->faker->paragraph(),
            'image' => 'https://firebasestorage.googleapis.com/v0/b/sampah-affbd.appspot.com/o/images%2F59efe59041aaccb9af4f2f5d715dae5d.jpegc323b408-5dcb-478d-8ce3-2637a5a1afaf?alt=media&token=59c50b79-7abb-4452-9ee9-b690d3d3467e',
        ];
    }
}
