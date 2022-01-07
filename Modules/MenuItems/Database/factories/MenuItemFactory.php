<?php
namespace Modules\MenuItems\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MenuItems\Entities\MenuItem;

class MenuItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MenuItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->randomNumber(2)
        ];
    }
}

