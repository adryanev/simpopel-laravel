<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>User::factory(),
            'tempat_lahir'=>$this->faker->city,
            'tanggal_lahir'=>$this->faker->date(),
            'jenis_kelamin'=>$this->faker->randomElement(['L','P']),
            'agama'=>'Islam',
            'nomor_hp'=>$this->faker->phoneNumber
        ];
    }
}
