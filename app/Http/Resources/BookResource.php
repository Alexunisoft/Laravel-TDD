<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "book_id" => $this->id,
            "book_title" => $this->title,
            "book_description" => $this->description,
            "author_name" => $this->author->name,
            "ISBN" => $this->ISBN
        ];
    }
}
