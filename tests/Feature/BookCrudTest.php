<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookCrudTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @var \Illuminate\Testing\TestResponse
     */
    private $response;

    public function testStatus201WithMessageCreatedWhenCreateABook()
    {
        $this->response->assertCreated();
        $this->response->assertJson(["message" => "Created"]);
    }

    public function testCountOfDatabaseInBooksTableIs1()
    {
        $this->assertDatabaseCount("books", 1);
    }

    private function data($data = [])
    {
        $author = Author::factory()->create();
        $default = [
            "title" => "Gone with the Wind",
            "description" => "Bestseller of New York Times",
            "author_id" => $author->id,
            "ISBN" => "12b-422-24ff"
        ];
        return array_merge($default, $data);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->response = $this->post("/books", $this->data());
    }
}
