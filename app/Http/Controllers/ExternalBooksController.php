<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Services\BooksServices;

class ExternalBooksController extends Controller
{
    public function index(BooksServices $item, $name)
    {
        $books = $item->externalBooks($name);

        return response()->json([
            'status_code' => 200,
            'status' => 'success',
            'data' => (count($books) > 0) ? $books['data'] : $books
        ]);
    }
}
