<?php

namespace Database\Seeders;

use App\Models\SociaLinkl;
use Illuminate\Database\Seeder;

class SociaLinklSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SociaLinkl::updateOrCreate([
            'fb_link' => 'https://www.facebook.com/',
            'twitter_link'=>'https://twitter.com/?lang=en',
            'instra_link'=>'https://www.instagram.com/'
    ]);
    }
}
