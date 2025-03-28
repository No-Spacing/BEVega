<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Category;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('admins')->insert([
            'username' => 'admin@email.com',
            'password' => hash::make('Admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $products = new Product();
        $products->name = 'Sunflower';
        $products->description = 'Created by Post Malone and Swae Lee. Song from Spider-man Into the Spider-Verse';
        $products->date = now();
        $products->save();

        $categories = new category();
        $categories->product_id = $products->id;
        $categories->name = 'Music';
        $categories->save();

        $products = new Product();
        $products->name = 'Redragon Draconic Pro';
        $products->description = 'Mechanical Keyboard with MX-Brown switches';
        $products->date = now();
        $products->save();

        $categories = new category();
        $categories->product_id = $products->id;
        $categories->name = 'Keyboard';
        $categories->save();

        $products = new Product();
        $products->name = 'Here With Me';
        $products->description = 'Created by Marshmello feat CHVRCHES in the year 2019.';
        $products->date = now();
        $products->save();

        $categories = new category();
        $categories->product_id = $products->id;
        $categories->name = 'Music';
        $categories->save();

        $products = new Product();
        $products->name = 'Corsair SCIMITAR RGB ELITE Optical MOBA/MMO Gaming Mouse';
        $products->description = '17 fully programmable (remappable) buttons, Key slider control system lets you position the side button panel to your hand, Highly precise optical sensor and Tested to 50 million clicks';
        $products->date = now();
        $products->save();

        $categories = new category();
        $categories->product_id = $products->id;
        $categories->name = 'Mouse';
        $categories->save();

        $products = new Product();
        $products->name = 'Aegis Z200';
        $products->description = 'Vape with Big screen, 3 buttons on the side and up-to 200Watts of power';
        $products->date = now();
        $products->save();

        $categories = new category();
        $categories->product_id = $products->id;
        $categories->name = 'Vape';
        $categories->save();

        $products = new Product();
        $products->name = 'Enook 18650 Charger';
        $products->description = 'Charger with smart controlling voltage for safe charging';
        $products->date = now();
        $products->save();

        $categories = new category();
        $categories->product_id = $products->id;
        $categories->name = 'Charger';
        $categories->save();

        $products = new Product();
        $products->name = 'MSI G242L E14';
        $products->description = 'Equipped with a 1920 x 1080, 144hz Refresh rate, 1ms MPRT response time IPS panel with built with Adaptive-Sync technology';
        $products->date = now();
        $products->save();

        $categories = new category();
        $categories->product_id = $products->id;
        $categories->name = 'Monitor';
        $categories->save();

        $products = new Product();
        $products->name = 'TUF Gaming VG28UQL1A HDMI 2.1 Gaming Monitor';
        $products->description = '28-inch UHD (3840 x 2160) Fast IPS gaming monitor with 144 Hz refresh rate and 1 ms (GTG) response time, HDMI® 2.1 supports native 4K 120 Hz gaming';
        $products->date = now();
        $products->save();

        $categories = new category();
        $categories->product_id = $products->id;
        $categories->name = 'Monitor';
        $categories->save();

        $products = new Product();
        $products->name = 'K100 RGB Optical-Mechanical Gaming Keyboard';
        $products->description = 'Corsair OPX switches tested for 150 million strokes, Stylish aluminum design with RGB edge, 8x faster responsiveness and Ultra durable keycap set';
        $products->date = now();
        $products->save();

        $categories = new category();
        $categories->product_id = $products->id;
        $categories->name = 'Keyboard';
        $categories->save();

        $products = new Product();
        $products->name = 'Nikon Z 30';
        $products->description = 'Portable and Travel-Friendly Our smallest, lightest mirrorless Z series camera, weighing just 12.4 oz (350 g).1 Superb Image Quality 20.9MP DX (APS-C) format sensor, several times larger than a smartphone. Effortless Autofocus for People and Pets Advanced tracking, including face and eye-detection.';
        $products->date = now();
        $products->save();

        $categories = new category();
        $categories->product_id = $products->id;
        $categories->name = 'Camera';
        $categories->save();
    }
}
