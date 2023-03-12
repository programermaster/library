<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pagination\Request as PaginationRequest;
use App\Models\Role;
use App\Http\Services\UserService;
use App\Http\Requests\User\{StoreRequest, UpdateRequest};

class UserController extends Controller
{

    /**
     * Display a listing of users.
     *
     * @param  PaginationRequest  $request
     * @param  UserService  $service
     */
    public function index(PaginationRequest $request, UserService $service)
    {
        return view('user.users', with(array(
            'users'=>$service->fetchAll($request)
        )));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  StoreRequest  $request
     * @param  UserService  $service
     */
    public function store(StoreRequest $request, UserService $service)
    {
        $service->store($request);

        return redirect()->route('users.index');
    }

    /**
     * Display the user.
     *
     * @param  int  $id
     * @param UserService
     */
    public function edit(int $id, UserService $service)
    {
        return view('user.edit', with(array(
            'user'=> $service->fetch($id),
            'roles'=>Role::all()
        )));
    }

    /**
     * Create the user.
     */
    public function create()
    {
        return view('user.create', with(array(
            'roles'=>Role::all()
        )));;
    }

    /**
     * Update the user in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @param  UserService  $service
     */
    public function update(UpdateRequest $request, int $id, UserService $service)
    {
        $service->update($request, $id);

        return redirect()->route('users.index');
    }

    /**
     * Remove the user from storage.
     *
     * @param  int  $id
     * @param  UserService  $service
     */
    public function destroy(int $id, UserService $service)
    {
        return $service->destroy($id);
    }
}
