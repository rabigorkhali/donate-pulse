<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CampaignCategory;
use Illuminate\Support\Str;

class CampaignCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Health & Medical',
            'Education',
            'Nonprofit & Charity',
            'Community',
            'Disaster Relief',
            'Creative Arts',
            'Entrepreneurship',
            'Environment & Sustainability',
            'Memorial & Funeral',
            'Sports',
            'Technology',
            'Animals & Pets',
            'Religious',
            'Family & Personal',
            'Food & Agriculture',
            'Events & Celebrations',
            'Music & Film',
            'Publishing & Journalism',
            'Travel & Adventure',
            'Fashion & Beauty'
        ];

        foreach ($categories as $category) {
            CampaignCategory::firstOrCreate(
                ['title' => $category],
                ['slug' => Str::slug($category)]
            );
        }
    }
}
