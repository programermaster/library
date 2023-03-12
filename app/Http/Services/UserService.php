<?php

namespace App\Http\Services;


use App\Http\Requests\Pagination\Request as PaginationRequest;
use App\Http\Traits\FilterCollection;
use App\Http\Requests\User\{StoreRequest, UpdateRequest};
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    use FilterCollection;

    /**
     * Fetch Users collection.
     *
     * @param  Request  $request
     * @return LengthAwarePaginator
     */
    public function fetchAll(PaginationRequest $request): LengthAwarePaginator
    {
        $query = $this->getFilters($request);
        $builder = User::query();

        $this->filterByQuery($builder, ['first_name', 'last_name', 'email'], $query->get('filter'));

        return $this->getResultPerPage($builder, $query);
    }

    /**
     * Fetch Author
     * @param $id
     * @return User
     */
    public function fetch(int $id):User
    {
        return User::query()->findOrFail($id);
    }

    /**
     * Update User.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return User
     */
    public function update(UpdateRequest $request, int $id):User
    {
        return tap(User::query()->findOrFail($id), function(User $user) use ($request){
            $validate = $request->validated();
            $validate["password"]= $request->isNotFilled('password') ? $user->password : \Illuminate\Support\Facades\Hash::make($request->password);
            $user->update($validate);

            $user->role()->sync($validate["role_id"]);
        });
    }

    /**
     * Create new User.
     *
     * @param  Request  $request
     * @return User
     */
    public function store(StoreRequest $request):User
    {
        $validate = $request->validated();
        $validate["password"] = \Hash::make($validate["password"]);
        $user = User::query()->create($validate);
        $user->role()->sync($validate["role_id"]);

        return $user;
    }

    /**
     * Soft-delete User.
     *
     * @param  int  $id User ID
     */
    public function destroy(int $id): bool
    {
        $user = User::query()->findOrFail($id);

        return $user->delete();
    }
}
