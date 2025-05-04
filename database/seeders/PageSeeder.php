<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::updateOrCreate([
            'title' => 'Home',
            'title_bn' => 'হোম',
            'slug' => 'home',
            'slno' => 1
        ]);
        Page::updateOrCreate([
            'title' => 'about-us - Home',
            'title_bn' => 'আমাদের সম্পর্কে - হোম',
            'slug' => 'about-us-home',
            'slno' => 2
        ]);
        Page::updateOrCreate([
            'title' => 'about-us',
            'title_bn' => 'আমাদের সম্পর্কে',
            'slug' => 'about-us',
            'slno' => 3
        ]);
        Page::updateOrCreate([
            'title' => 'Sapox',
            'title_bn' => 'সেপকস',
            'slug' => 'about-us',
            'description_bn' => 'বাংলাদেশ সেনাবাহিনীতে কর্মরত জুনিয়র কমিশন্ড অফিসার , নন-কমিশন্ড অফিসার , অন্যান্য পদবির সৈনিক , এমওডিসি , বেসামরিক কর্মচারীদের পরিবারবর্গের , সামাজিক, সাংস্কৃীতিক , শিক্ষা, অর্থনৈতিক ও অন্যান্য',
            'slno' => 4
        ]);
    }
}
