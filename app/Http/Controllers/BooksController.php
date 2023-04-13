<?php

namespace App\Http\Controllers;

use App\Http\Requests\BooksRequest;
use App\Http\Requests\UpdateBooksRequest;
use App\Http\Resources\BooksResource;
use App\Http\Resources\ShowBooksResource;
use App\Http\Resources\UpdateBooksResource;
use Illuminate\Http\Request;
use App\Services\BooksServices;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $books = Book::all();
        if($request->input('name'))$params = $request->input('name');
        if($request->input('country'))$params = $request->input('country');
        if($request->input('publisher'))$params = $request->input('publisher');
        if($request->input('release_date'))$params = $request->input('release_date');

        if(!$request->input('name') && !$request->input('country') &&
        !$request->input('publisher') && !$request->input('release_date'))$params = '';

        $search = '';
        if ($request->input('name')) {
            $search = 'name';
        }
        if ($request->input('country')) {
            $search = 'country';
        }
        if ($request->input('publisher')) {
            $search = 'publisher';
        }
        if ($request->input('release_date')) {
            $search = 'release_date';
        }

        if ($search != null) {
            $books = $books->where($params, $search);
        }

        return new BooksResource($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BooksRequest $request, BooksServices $item)
    {
        $book = $item->storeBook($request->validated());
        return new BooksResource($book);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BooksServices $item, $id)
    {
        $book = $item->getSingleBook($id);
        return new ShowBooksResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBooksRequest $request, BooksServices $item, $id)
    {
        $book = $item->updateBook($request->validated(), $id);
        return new UpdateBooksResource($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BooksServices $item, $id)
    {
        $book = $item->getSingleBook($id);
        if ($book) {
            $name = $book->name;
            DB::table('author_book')->where('book_id', $book->id)->delete();
            $book->delete();
            return response()->json([
                'status_code' => 204,
                'status' => 'success',
                'message' => "The book {$name} was deleted successfully",
                'data' => []
            ]);
        } else {
            return response()->json([
                'status_code' => 404,
                'status' => 'Not Found'
            ]);
        }
    }
}
