<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Motel>
 */
class MotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "room_number" => fake()->name(),
            "price" => 1000,
            "area" => 200,
            "area_id" => 1 ,
            "description" => "description",
            "image_360" => "https://cdn.tgdd.vn/Files/2016/06/11/840487/1234.jpg",
            "photo_gallery" => '[
                "https://bizweb.dktcdn.net/thumb/1024x1024/100/328/080/products/16.jpg?v=1534254237630",
                "https://bizweb.dktcdn.net/thumb/1024x1024/100/328/080/products/ss.png?v=1534254242320",
                "https://bizweb.dktcdn.net/100/328/080/products/2a6b6f5c3983a4f979910978d28ec7-863b57ec-7edc-495f-bf32-a0bb14cf8797.jpg?v=1534254242320"
            ]',
            "services" => '[
                "service 1",
                "service 2",
                "service 3",
                "service 4",
                "service 5",
                "service 6",
                "service 7"
            ]',
            "status" => 1,
            "max_people" =>5,
            "start_time" => now(),
            "end_time" => now(),
            "category_id" => 1
        ];
    }
}
