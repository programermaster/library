<?php

namespace App\Http\Services;

use App\Http\Requests\Pagination\Request as PaginationRequest;
use App\Http\Traits\FilterCollection;
use App\Http\Requests\Author\Request;
use App\Http\Traits\UploadImage;
use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class AuthorService
{
    use FilterCollection;
    use UploadImage;

    /**
     * Fetch Authors.
     *
     * @param  PaginationRequest  $request
     * @return LengthAwarePaginator
     */
    public function fetchAll(PaginationRequest $request): LengthAwarePaginator
    {
        $query = $this->getFilters($request);
        $builder = Author::query();

        if(!$request->isNotFilled("filter")){
            $this->filterByQuery($builder, ['first_name', 'last_name'], $query->get('filter'));
        }

        return $this->getResultPerPage($builder, $query);
    }

    /**
     * Fetch Author
     * @param $id
     * @return Author
     */
    public function fetch(int $id):Author
    {
        return Author::query()->findOrFail($id);
    }


    /**
     * Update author.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Author
     */
    public function update(Request $request, int $id):Author
    {
        return tap(Author::query()->findOrFail($id), function(Author $author) use ($request){
            $data = $request->validated();
            $data["image"] = $this->uploadImage($request);
            $author->update($data);
        });
    }

    /**
     * Create new author.
     *
     * @param  Request  $request
     * @return Author
     */
    public function store(Request $request):Author
    {
        $author = Author::query()->create($request->validated());

        return tap($author, function(Author $author) use ($request){
            $author->update(['image' => $this->uploadImage($request)]);
        });
    }

    /**
     * Soft-delete author.
     *
     * @param  int  $id Author ID
     */
    public function destroy(int $id): bool
    {
        $author = Author::query()->findOrFail($id);

        return $author->delete();
    }
}
