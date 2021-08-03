<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $categories = config('nav.categories');
        foreach($categories as $category) {
            DB::table('categories')->insert([
                'title' => $category,
                'description' => $category,
            ]);
        }
    }
}