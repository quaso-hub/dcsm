<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $payment = fake()->boolean(60) ? Payment::inRandomOrder()->first()?->id : null;

        return [
            'user_id' => $user->id,
            'payment_id' => $payment,
            'order_type' => $this->faker->randomElement(['dine-in', 'take-away']),
            'status' => $payment
                ? $this->faker->randomElement(['processing', 'completed'])
                : $this->faker->randomElement(['pending', 'cancelled']),
            'total_amount' => 0,
        ];
    }
}
