<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class BookCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var TestResponse
     */
    private $response;
    /**
     * @var Collection|Model|mixed
     */
    private $user;

    public function testStatus201WithMessageCreatedWhenCreateABookWhenAuthenticated()
    {
        $response = $this->actingAs($this->user)->post("/books", $this->data());
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
        $this->actingAs($this->user)->post("/books", $this->data());
        $this->assertDatabaseCount("books", 1);
    }

    public function testAssertValidatedCookieExistsAfterVisitingBooksRoute()
    {
        $response = $this->actingAs($this->user)->post("/books", $this->data());
        $response->assertCookie("validated", "yes");
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }
}
