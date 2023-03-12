@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(Auth::user()->is_librarian)
        <div class="col-md-12" style="margin-bottom: 50px">
            <a href="{{route("users.create")}}">Add New User</a>
        </div>
        @endif

        <div class="col-md-12" style="margin-bottom: 50px">
            <form method="get" action="">
                Search : <input type="text" name="filter" value="{{app('request')->input('filter')}}" />
            </form>
        </div>

        <table class="table table-striped table-bordered col-md-12 ">
            <thead>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
            </thead>
            <tbody>
                    @foreach($users as $key=>$user)
                    <tr>
                        <td><h3>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{!! $user->email  !!}</td>
                        <td>@foreach($user->role as $role) <p>{!! $role->name  !!}</p>@endforeach</td>
                        <td><a href="{{route('users.edit', $user->id)}}">Edit</a></td>
                        <td><a class="delete" data-url="{{route("users.destroy", $user->id)}}">Delete</a></td>
                    </tr>
                    @endforeach
                    {{ $users->links() }}
            </tbody>
        </table>
    </div>
</div>
@endsection
