<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'jabatan'=>$this->faker->randomElement(['Guru','Wakil Kesiswaan']),
            'status'=>$this->faker->randomElement(['PNS','Honorer']),
            'pendidikan'=>$this->faker->randomElement(['S1','S2','D3']),
            'bidang_studi'=>$this->faker->randomElement(['Agama','Matematika','IPA','IPS','Kesenian']),
            'tahun_tamat'=>$this->faker->year,
            'masa_kerja'=>$this->faker->randomNumber(1)
        ];
    }
}
