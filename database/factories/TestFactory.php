<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            //nbMaxDecimals 小数点保留位数   min：最小值  max ：最大值
            'amount'=>$this->faker->randomFloat(2,0,100),
            'address'=>$this->faker->address(),
        ];
    }

}
