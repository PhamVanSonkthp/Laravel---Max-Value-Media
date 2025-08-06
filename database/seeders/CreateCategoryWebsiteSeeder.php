<?php

namespace Database\Seeders;

use App\Models\CategoryWebsite;
use App\Models\News;
use Illuminate\Database\Seeder;

class CreateCategoryWebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryWebsite::firstOrCreate([
            "name" => "Arts & Entertainment",
            "adserver_id" => "13",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Automotive",
            "adserver_id" => "33",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Business",
            "adserver_id" => "34",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Careers",
            "adserver_id" => "35",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Education",
            "adserver_id" => "36",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Family & Parenting",
            "adserver_id" => "37",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Food & Drink",
            "adserver_id" => "39",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Health & fitness",
            "adserver_id" => "28",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Hobbies & Interests",
            "adserver_id" => "10",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Home & Garden",
            "adserver_id" => "41",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Law, Government, & Politics",
            "adserver_id" => "42",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "News & Media",
            "adserver_id" => "11",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Personal Finance",
            "adserver_id" => "7",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Pets",
            "adserver_id" => "47",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Real Estate",
            "adserver_id" => "52",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Science",
            "adserver_id" => "46",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Shopping",
            "adserver_id" => "23",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Society",
            "adserver_id" => "8",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Sports",
            "adserver_id" => "5",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Style & Fashion",
            "adserver_id" => "49",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Technology & Computing",
            "adserver_id" => "6",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Travel",
            "adserver_id" => "51",
        ]);
        CategoryWebsite::firstOrCreate([
            "name" => "Uncategorized",
            "adserver_id" => "31",
        ]);

    }
}
