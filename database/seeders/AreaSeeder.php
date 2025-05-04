<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::updateOrCreate([
            'name' => 'Dhaka',
            'name_bn' => 'ঢাকা'
        ]);
        Area::updateOrCreate([
            'name' => 'Barishal',
            'name_bn' => 'বরিশাল'
        ]);
        Area::updateOrCreate([
            'name' => 'Savar',
            'name_bn' => 'সাভার'
        ]);
        Area::updateOrCreate([
            'name' => 'Cox-Bazar',
            'name_bn' => 'কক্সবাজার'
        ]);
        Area::updateOrCreate([
            'name' => 'Bagura',
            'name_bn' => 'বগুড়া'
        ]);
        Area::updateOrCreate([
            'name' => 'Sylhet',
            'name_bn' => 'সিলেট'
        ]);
        Area::updateOrCreate([
            'name' => 'Gatail',
            'name_bn' => 'ঘাটাইল'
        ]);
        Area::updateOrCreate([
            'name' => 'Chittagong',
            'name_bn' => 'চট্টগ্রাম'
        ]);
        Area::updateOrCreate([
            'name' => 'Cumilla',
            'name_bn' => 'কুমিল্লা'
        ]);
        Area::updateOrCreate([
            'name' => 'Jashore',
            'name_bn' => 'যশোর'
        ]);
        Area::updateOrCreate([
            'name' => 'Rangpur',
            'name_bn' => 'রংপুর'
        ]);
        Area::updateOrCreate([
            'name' => 'BMA',
            'name_bn' => 'বিএমএ'
        ]);
        Area::updateOrCreate([
            'name' => 'Jalalabad',
            'name_bn' => 'জালালাবাদ'
        ]);
        Area::updateOrCreate([
            'name' => 'Rajentropur',
            'name_bn' => 'রাজেন্দ্রপুর'
        ]);
    }
}
