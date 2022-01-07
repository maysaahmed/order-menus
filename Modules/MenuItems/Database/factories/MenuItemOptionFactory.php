<?php
namespace Modules\MenuItems\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemOptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\MenuItems\Entities\MenuItemOption::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'maxQty' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomNumber(2)
        ];
    }
}

