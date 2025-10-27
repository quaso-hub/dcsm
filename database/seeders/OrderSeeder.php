<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // $foods = Food::with('items')->get();

        // Order::factory()->count(10)->create()->each(function ($order) use ($foods) {
        //     $total = 0;

        //     foreach (range(1, rand(1, 5)) as $_) {
        //         $food = $foods->random();
        //         $quantity = rand(1, 5);
        //         $detail = $order->details()->create([
        //             'food_id' => $food->id,
        //             'quantity' => $quantity,
        //             'note' => fake()->optional()->sentence(),
        //         ]);
        //         $total += $food->base_price * $quantity;

        //         $options = $food->items->random(rand(0, min(2, $food->items->count())));
        //         foreach ($options as $opt) {
        //             $detail->options()->create([
        //                 'food_item_id' => $opt->id
        //             ]);
        //         }
        //     }

        //     $order->update(['total_amount' => $total]);
        // });
    }
}
