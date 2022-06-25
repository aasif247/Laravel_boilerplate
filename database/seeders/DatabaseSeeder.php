<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('application_settings')->insert([
            [
                'key' => 'app_name',
                'value' => 'Demo Work Laravel',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'notification_sound',
                'value' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'display_record_per_page',
                'value' => 25,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'timezone',
                'value' => 'Asia/Dhaka',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'date_format',
                'value' => 'm-d-Y',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'time_format',
                'value' => 12,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'no_image',
                'value' => 'uploads/settings/no_image_available.png',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'logo_sm',
                'value' => 'uploads/settings/logo_sm.png',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'logo_light',
                'value' => 'uploads/settings/logo_light.png',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'logo_dark',
                'value' => 'uploads/settings/logo_dark.png',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'favicon',
                'value' => 'uploads/settings/favicon.png',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()
            ]
        ]);

        DB::table('users')->insert([
                'name' => 'Example User',
                'email' => 'demo@example.com',
                'password' => bcrypt('123456'),
                'profile_photo_path' => 'uploads/users/default_profile_picture.png',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('categories')->insert([
                'category_name' => 'Demo Category',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('products')->insert([
                'category_id' => 1,
                'product_name' => 'Demo Product',
                'product_price' => '14.5',
                'sku' => uniqid('SD'),
                'created_by' => 1,
                'product_photo_path' => 'uploads/products/default_product_image.png',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
