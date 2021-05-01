<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->realText(),
            "description" => $this->faker->realText(),
            "author_id" => Author::factory()->create()->id,
            "ISBN" => $this->faker->regexify("(\d|\w){3}-(\d|\w){3}-(\d|\w){4}"),
        ];
    }
}
