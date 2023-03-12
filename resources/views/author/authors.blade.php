@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12" style="margin-bottom: 50px">
            <a href="{{route("authors.create")}}">Add New Author</a>
        </div>

        <div class="col-md-12" style="margin-bottom: 50px">
            <form method="get" action="">
               Search : <input type="text" name="filter" value="{{app('request')->input('filter')}}" />
            </form>
        </div>

        <table class="table table-striped table-bordered col-md-12 ">
            <thead>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Image</th>
            </thead>
            <tbody>
            @foreach($authors as $key=>$author)
            <tr>
                <td><h3>{{ $author->first_name }}</td>
                <td>{!! $author->last_name  !!}</td>
                <td>@if(!empty($author->fullPathImage)) <img id="photo-preview" width="50" src="{{$author->fullPathImage}}">@endif</td>
                <td><a href="{{route('authors.edit', $author->id)}}">Edit</a></td>
                <td><a class="delete" data-url="{{route("authors.destroy", $author->id)}}">Delete</a></td>
            </tr>
            @endforeach
            {{ $authors->links() }}
            </tbody>
        </table>
    </div>
</div>

@endsection
