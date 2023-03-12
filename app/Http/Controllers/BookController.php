<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pagination\Request as PaginationRequest;
use App\Http\Services\AuthorService;
use App\Http\Services\BookService;
use App\Http\Requests\Book\Request;
use App\Models\Author;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of books.
     *
     * @param  PaginationRequest  $request
     * @param  BookService  $service
     */
    public function index(PaginationRequest $request, BookService $service)
    {
        return view('book.books', with(array(
            'books'=>$service->fetchAll($request)
        )));
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  Request  $request
     * @param  BookService  $service
     */
    public function store(Request $request, BookService $service)
    {
        $service->store($request);

        return redirect()->route('books.index');
    }

    /**
     * Display the author.
     *
     * @param  int  $id
     * @param BookService
     */
    public function edit(int $id, BookService $service)
    {
        return view('book.edit', with(array(
            'book'=>$service->fetch($id),
            'authors'=>Author::all()
        )));
    }

    /**
     *  Show form for add new book .
     */
    public function create()
    {
        return view('book.create', with(array(
            'authors'=>Author::all()
        )));
    }

    /**
     * Update the book in storage.
     *
     * @param  Request  $request
     * @param  Book $book
     * @param  BookService  $service
     */
    public function update(Request $request, Book $book, BookService $service)
    {

        $service->update($request, $book->id);

        return redirect()->route('books.index', $book->id);
    }

    /**
     * Remove the book from storage.
     *
     * @param  int  $id
     * @param  BookService  $service
     */
    public function destroy(int $id, BookService $service)
    {
        return $service->destroy($id);
    }
}
