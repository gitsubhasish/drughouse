<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class ManufacturerSeeder extends Seeder
{
    public function run(): void
    {
        $manufacturers = [
            ['name' => 'Cipla', 'description' => 'Leading Indian pharmaceutical company'],
            ['name' => 'Sun Pharma', 'description' => 'Global pharma company based in India'],
            ['name' => 'Pfizer', 'description' => 'American multinational pharmaceutical corporation'],
        ];

        foreach ($manufacturers as $man) {
            $imageName = 'manufacturers/' . Str::slug($man['name']) . '.jpg';
            $imageUrl = 'https://picsum.photos/seed/' . Str::slug($man['name']) . '/600/400';

            if (!Storage::disk('public')->exists($imageName)) {
                $response = Http::withoutVerifying()->get($imageUrl); // disables SSL verification
                Storage::disk('public')->put($imageName, $response->body());
            }

            Manufacturer::create([
                'name' => $man['name'],
                'image' => $imageName,
                'description' => $man['description'],
            ]);
        }
    }
}
