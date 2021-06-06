<?php

namespace Database\Factories;

use App\Models\Kanri;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\User;

class KanriFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kanri::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bikou'=>"特になし",
            'info'=>"出勤",
            'user_id'=>User::factory(),
            'created_at'=>"2020-10-10 00:00:00",
        ];
    }
}
