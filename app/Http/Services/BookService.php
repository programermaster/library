<?php

namespace App\Http\Services;

use App\Http\Requests\Pagination\Request as PaginationRequest;
use App\Http\Traits\FilterCollection;
use App\Http\Requests\Book\Request;
use App\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BookService
{
    use FilterCollection;

    /**
     * Fetch Books collection.
     *
     * @param  PaginationRequest  $request
     * @return LengthAwarePaginator
     */
    public function fetchAll(PaginationRequest $request): LengthAwarePaginator
    {
        $query = $this->getFilters($request);
        $builder = Book::with("Author");

        $this->filterByQuery($builder, [ 'title', 'description', 'book_number'], $query->get('filter'));

        return $this->getResultPerPage($builder, $query);
    }

    /**
     * Fetch Book
     * @param $id
     * @return Book
     */
    public function fetch(int $id):Book
    {
        return Book::query()->findOrFail($id);
    }

    /**
     * Update Book.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Book
     */
    public function update(Request $request, int $id):Book
    {
        return tap(Book::query()->findOrFail($id), function(Book $book) use ($request){
            $book->update($request->validated());
        });
    }

    /**
     * Create new Book.
     *
     * @param  Request  $request
     * @return Book
     */
    public function store(Request $request):Book
    {
        $book = Book::query()->create($request->validated());

        return $book;
    }

    /**
     * Soft-delete Book.
     *
     * @param  int  $id Book ID
     */
    public function destroy(int $id): bool
    {
        $book = Book::query()->findOrFail($id);

        return $book->delete();
    }
}
