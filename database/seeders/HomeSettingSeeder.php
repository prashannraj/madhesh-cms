<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HomeSetting;
use Illuminate\Support\Facades\DB;

class HomeSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeSetting::create([
            'hero_title' => 'प्रदेश जनलोकपाल आयोग',
            'welcome_text' => 'हामी जनताको सेवामा समर्पित छौं।',
            'seo_title' => 'प्रदेश जनलोकपाल आयोग - Madhesh Lokpal',
            'seo_description' => 'जनगुनासो समाधान तथा पारदर्शिता अभिवृद्धिका लागि समर्पित संस्था।',
        ]);
    }
}
