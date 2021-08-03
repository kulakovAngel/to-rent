<?php

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $items = ['Car', 'Scooter', 'Skates'];
        foreach($items as $item) {
            App\Item::create([
                'title'  =>  $item,
                'quantity' => rand(1, 5),
                'in_stock' => 1
            ]);
        }
    }
}
