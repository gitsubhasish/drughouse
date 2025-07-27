<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medicine;
use App\Models\MedicineImage;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Unit;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id')->toArray();
        $manufacturers = Manufacturer::pluck('id')->toArray();
        $units = Unit::pluck('id')->toArray();

        for ($i = 1; $i <= 20; $i++) {
            $medicine = Medicine::create([
                'name' => 'Medicine ' . $i,
                'description' => 'Description for medicine ' . $i,
                'batch_no' => 'BATCH-' . strtoupper(Str::random(5)),
                'mrp' => rand(50, 500),
                'price' => rand(30, 400),
                'expiry_date' => Carbon::now()->addMonths(rand(6, 24)),
                'total_stock' => rand(50, 500),
                'is_featured' => (bool)rand(0, 1),
                'category_id' => $categories[array_rand($categories)],
                'manufacturer_id' => $manufacturers[array_rand($manufacturers)],
                'unit_id' => $units[array_rand($units)],
            ]);

            // Attach 2-4 images per medicine
            $numImages = rand(2, 4);
            for ($j = 1; $j <= $numImages; $j++) {
                $imageName = 'medicines/' . Str::slug($medicine->name) . '-' . Str::random(5) . '.jpg';
                $imageUrl = 'https://picsum.photos/seed/' . Str::slug($medicine->name) . '-' . $j . '/600/400';

                if (!Storage::disk('public')->exists($imageName)) {
                    $imageData = file_get_contents($imageUrl);
                    Storage::disk('public')->put($imageName, $imageData);
                }

                MedicineImage::create([
                    'medicine_id' => $medicine->id,
                    'image' => $imageName,
                ]);
            }
        }
    }
}
