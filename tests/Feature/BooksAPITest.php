<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BooksAPITest extends TestCase
{
    use RefreshDatabase;

    public function testHitOnBooksApiReturnsJson()
    {
        $response = $this->getJson("/api/books");
        $response->assertOk();
        $response->assertHeader("Content-Type", "application/json");
    }

    public function testHitOnBooksApiReturnsDesignatedContract()
    {
        $book = Book::factory()->create();
        $response = $this->getJson("/api/books");
        $response->assertJson([
            "books" => [
                [
                    "book_id" => $book->id,
                    "book_title" => $book->title,
                    "book_description" => $book->description,
                    "author_name" => $book->author->name,
                    "ISBN" => $book->ISBN
                ]
            ]
        ]);
    }
}
