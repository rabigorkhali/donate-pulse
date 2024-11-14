<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Seeder;
use App\Models\CampaignCategory;
use Illuminate\Support\Str;

class PostCategorySeeder extends Seeder
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
            PostCategory::firstOrCreate(
                ['name' => $category],
                ['slug' => Str::slug($category)]
            );
        }
    }
}
