<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Product::truncate();

        Product::insert([
            [
                'name' => 'The King Majestic Silver-01',
                'description' => 'A timeless classic in polished silver stainless steel with a sleek, minimalist dial — perfect for formal and everyday wear.',
                'price' => 249.00,
                'stock' => 60,
                'image_url' => 'frontend/assets/images/1766580550_The King Majestic Silver-01.webp',
                'status' => 'ACTIVE',
                'created_at' => '2025-12-24 12:47:21',
                'updated_at' => '2025-12-24 12:49:10',
            ],
            [
                'name' => 'The King Majestic Gold‑02',
                'description' => 'Radiant gold finish with refined detailing, combining luxury and everyday practicality for a statement look.',
                'price' => 279.00,
                'stock' => 80,
                'image_url' => 'frontend/assets/images/1766580682_The King Majestic Gold-02.webp',
                'status' => 'ACTIVE',
                'created_at' => '2025-12-24 12:51:22',
                'updated_at' => '2025-12-24 12:51:22',
            ],
            [
                'name' => 'The King Marvelous Gold‑03',
                'description' => 'Bold and opulent, this golden timepiece elevates any outfit with its luxe design and elegant craftsmanship.',
                'price' => 299.00,
                'stock' => 90,
                'image_url' => 'frontend/assets/images/1766580735_The King Marvelous Gold-03.webp',
                'status' => 'ACTIVE',
                'created_at' => '2025-12-24 12:52:15',
                'updated_at' => '2025-12-24 12:52:15',
            ],
            [
                'name' => 'The King Marvelous Silver‑04',
                'description' => 'Sleek silver tones with modern flair — a versatile choice that transitions easily from office to night out.',
                'price' => 265.00,
                'stock' => 120,
                'image_url' => 'frontend/assets/images/1766580761_The King Marvelous Silver-04.webp',
                'status' => 'ACTIVE',
                'created_at' => '2025-12-24 12:52:41',
                'updated_at' => '2025-12-24 12:52:41',
            ],
            [
                'name' => 'VARMAN THE APSARA ANGKOR‑05',
                'description' => 'Inspired by the timeless elegance of Angkor art, featuring intricate motifs and cultural sophistication.',
                'price' => 319.00,
                'stock' => 70,
                'image_url' => 'frontend/assets/images/1766580790_VARMAN THE APSARA ANGKOR-05.webp',
                'status' => 'ACTIVE',
                'created_at' => '2025-12-24 12:53:10',
                'updated_at' => '2025-12-24 12:53:10',
            ],
            [
                'name' => 'VARMAN BAME3 GOLD‑06',
                'description' => 'Prestige and bold design in luminous gold — a striking piece for those who appreciate luxury and presence.',
                'price' => 289.00,
                'stock' => 80,
                'image_url' => 'frontend/assets/images/1766580817_VARMAN BAME3 GOLD-06.webp',
                'status' => 'ACTIVE',
                'created_at' => '2025-12-24 12:53:37',
                'updated_at' => '2025-12-24 12:53:37',
            ],
            [
                'name' => 'The AirCross Next‑Gen‑07',
                'description' => 'Futuristic and lightweight with a modern silhouette — perfect for trendsetters and active lifestyles.',
                'price' => 229.00,
                'stock' => 85,
                'image_url' => 'frontend/assets/images/1766580841_The AirCross Next-Gen-07.webp',
                'status' => 'ACTIVE',
                'created_at' => '2025-12-24 12:54:01',
                'updated_at' => '2025-12-24 12:54:01',
            ],
            [
                'name' => 'Varman Milky Way‑08',
                'description' => 'A celestial-inspired dial with shimmering accents that evoke the beauty of the night sky.',
                'price' => 279.00,
                'stock' => 90,
                'image_url' => 'frontend/assets/images/1766580878_Varman Milky Way-08.webp',
                'status' => 'ACTIVE',
                'created_at' => '2025-12-24 12:54:38',
                'updated_at' => '2025-12-24 12:54:38',
            ],
            [
                'name' => 'Varman The Elite Rose‑09',
                'description' => 'Soft rose gold paired with refined design — elegant and stylish for both everyday and special occasions.',
                'price' => 259.00,
                'stock' => 75,
                'image_url' => 'frontend/assets/images/1766580907_Varman The Elite Rose-09.webp',
                'status' => 'ACTIVE',
                'created_at' => '2025-12-24 12:55:07',
                'updated_at' => '2025-12-24 12:55:07',
            ],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        User::factory()->create([
            'name' => 'myadmin',
            'email' => 'myadmin@gamil.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
