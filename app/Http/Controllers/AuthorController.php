<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pagination\Request as PaginationRequest;
use App\Http\Services\AuthorService;
use App\Http\Requests\Author\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of authors.
     *
     * @param  PaginationRequest  $request
     * @param  AuthorService  $service
     */
    public function index(PaginationRequest $request, AuthorService $service)
    {
        return view('author.authors', with(array(
            'authors'=>$service->fetchAll($request)
        )));
    }

    /**
     * Store a newly created author in storage.
     *
     * @param  Request  $request
     * @param  AuthorService  $service
     */
    public function store(Request $request, AuthorService $service)
    {
        $service->store($request);

        return redirect()->route('authors.index');
    }

    /**
     * Display the author.
     *
     * @param  int  $id
     * @param AuthorService
     */
    public function edit(int $id, AuthorService $service)
    {
        return view('author.edit', with(array(
            'author'=>$service->fetch($id)
        )));
    }

    /**
     *  Show form for add new author
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Update the author in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @param  AuthorService  $service
     */
    public function update(Request $request, int $id, AuthorService $service)
    {
        $service->update($request, $id);

        return redirect()->route('authors.index', $id);
    }

    /**
     * Remove the author from storage.
     *
     * @param  int  $id
     * @param  AuthorService  $service
     */
    public function destroy(int $id, AuthorService $service):bool
    {
        return $service->destroy($id);
    }
}
