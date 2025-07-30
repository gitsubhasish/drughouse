<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Pain Relief', 'description' => 'Medicines for pain management'],
            ['name' => 'Antibiotics', 'description' => 'Used to treat bacterial infections'],
            ['name' => 'Vitamins', 'description' => 'Nutritional supplements for health'],
        ];

        foreach ($categories as $cat) {
            $imageName = 'categories/' . Str::slug($cat['name']) . '.jpg';
            $imageUrl = 'https://picsum.photos/seed/' . Str::slug($cat['name']) . '/600/400';

            if (!Storage::disk('public')->exists($imageName)) {
                $response = Http::withoutVerifying()->get($imageUrl); // disables SSL verification
                Storage::disk('public')->put($imageName, $response->body());
            }

            Category::create([
                'name' => $cat['name'],
                'image' => $imageName,
                'description' => $cat['description'],
            ]);
        }
    }
}
