<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete all records from the tags table
        //DB::table('tags')->delete();

         // Temporarily disable foreign key checks
         DB::statement('SET FOREIGN_KEY_CHECKS=0;');

         // Truncate the tags table
         Tag::truncate();
 
         // Re-enable foreign key checks
         DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $tags = ['Diwali', 'Pooja', 'New Year', 'Aarti', 'Wedding'];

        foreach ($tags as $tagName) {
            Tag::firstOrCreate(['name' => $tagName]);
        }

        // Generate unique tags using the factory
        //Tag::factory()->count(10)->create();
    }
}
