<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AuthorResource;

class BooksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $output = [
            'status_code' => 201,
            'status' => 'success',
            'data' => [
                'name' => $this->name,
                'isbn' => $this->isbn,
                'authors' => collect(AuthorResource::collection($this->authors))->collapse(),
                'number_of_pages' => $this->number_of_pages,
                'publisher' => $this->publisher,
                'country' => $this->country,
                'release_date' => $this->release_date
            ]
        ];
        return $output;
    }
}
