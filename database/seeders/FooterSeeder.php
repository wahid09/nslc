<?php

namespace Database\Seeders;

use App\Models\Footer;
use Illuminate\Database\Seeder;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Footer::updateOrCreate([
        'slogan_bn' => 'বাংলাদেশ সেনাবাহিনীতে কর্মরত সামরিক এবং বেসামরিক কর্মচারীদের  সামাজিক, সাংস্কৃীতিক , শিক্ষা, অর্থনৈতিক কার্যাবলী উন্নয়নের লক্ষ্যে সমাজসেবা অধিদপ্তর এ নিবন্ধনকৃত সেনা পরিবার কল্যাণ সমিতি।',
        'contact_bn' => 'সেনা পরিবার কল্যান সমিতি (কেন্দ্রীয় কার্যালয়) সূর্যকন্যা, নির্ঝর আবাসিক এলাকা, ঢাকা সেনানিবাস
ফোনঃ ০২-৯৮৩২০০৬, ইমেইলঃ spksdhaka@gmail.com',
            'logo'=>'https://via.placeholder.com/100x100'
    ]);
    }
}
