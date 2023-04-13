<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Book;

class BooksServices {

    public function externalBooks(string $name)
    {
        $books = collect(json_decode(Http::get('https://www.anapioficeandfire.com/api/books')->body()));
        $filter_books = $books->where('name', $name);     
        return $this->custom_filter_array($filter_books);
    }

    public function custom_filter_array($array)
    {
        $record = [];
        if (count($array) > 0) {
            foreach ($array as $data => $value) {
                $record['data'] = $value;
            }
            unset($record['data']->characters);
            unset($record['data']->povCharacters);
        }
        return $record;
    }

    public function storeBook(array $details)
    {
        $book = new Book();
        $book->name = $details['name'];
        $book->isbn = $details['isbn'];
        $book->country = $details['country'];
        $book->number_of_pages = $details['number_of_pages'];
        $book->publisher = $details['publisher'];
        $book->release_date = $details['release_date'];
        $book->save();

        $book->authors()->attach($details['authors']);
        $new_book = $this->getSingleBook($book->id);

        return $new_book;
    }

    public function getSingleBook(int $id)
    {
        return Book::with('authors')->where('id', $id)->first();
    }

    public function updateBook(array $details, int $id)
    {
        $book = Book::findOrFail($id);
        $book->name = $details['name'] ?? $book->name;
        $book->isbn = $details['isbn'] ?? $book->isbn;
        $book->country = $details['country'] ?? $book->country;
        $book->number_of_pages = $details['number_of_pages'] ?? $book->number_of_pages;
        $book->publisher = $details['publisher'] ?? $book->publisher;
        $book->release_date = $details['release_date'] ?? $book->release_date;
        $book->save();

        if (isset($details['authors'])) {
            $book->authors()->sync($details['authors']);
        }

        $updated_book = $this->getSingleBook($book->id);
        return $updated_book;
    }

}