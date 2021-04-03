<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookManagementTest extends TestCase
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

    protected function setUp(): void
    {
        parent::setUp();
        $this->response = $this->post("/books", $this->data());
    }
}
