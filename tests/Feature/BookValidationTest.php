<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookValidationTest extends TestCase
{
    use RefreshDatabase;

    public function testCannotCreateBookWithEmptyTitle()
    {
        $response = $this->post("/books", $this->data(["title" => ""]));
        $response->assertSessionHasErrors(["title" => "title is required"]);
    }

    private function data($data = [])
    {
        $default = [
            "title" => "Gone with the Wind",
            "description" => "Bestseller of New York Times",
            "author_id" => 1,
            "ISBN" => "12b-422-24ff"
        ];
        return array_merge($default, $data);
    }

    public function testDescriptionIsRequired()
    {
        $response = $this->post("/books", $this->data(["description" => ""]));
        $response->assertSessionHasErrors(["description" => "description is required"]);
    }

    public function testDescriptionLengthMinimumIs20Characters()
    {
        $response = $this->post("/books", $this->data(["description" => "ddd"]));
        $response->assertSessionHasErrors(["description" => "description length minimum is 20"]);
    }

    public function testAuthorIdMustBeValid()
    {
        $response = $this->post("/books", $this->data());
        $response->assertSessionHasErrors(["author_id" => "Author must be valid"]);
    }

    public function testIsbnMustBeOfValidFormat()
    {
        $response = $this->post("/books", $this->data(["ISBN" => "asfgawer"]));
        $response->assertSessionHasErrors(["ISBN" => "ISBN must be of valid format"]);
    }
}
