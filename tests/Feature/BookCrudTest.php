<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookCrudTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @var \Illuminate\Testing\TestResponse
     */
    private $response;

    public function testStatus201WithMessageCreatedWhenCreateABookWhenAuthenticated()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post("/books", $this->data());
        $response->assertCreated();
        $response->assertJson(["message" => "Created"]);
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

    public function testRedirectToLoginIfNotAuthenticatedWith302Status()
    {
        $response = $this->post("/books", $this->data());
        $response->assertStatus(302);
        $response->assertRedirect("/login");
    }

    public function testCountOfDatabaseInBooksTableIs1()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->post("/books", $this->data());
        $this->assertDatabaseCount("books", 1);
    }

    public function testAssertValidatedCookieExistsAfterVisitingBooksRoute()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post("/books", $this->data());
        $response->assertCookie("validated", "yes");
    }
}
