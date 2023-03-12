@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(Auth::user()->is_librarian)
        <div class="col-md-12" style="margin-bottom: 50px">
            <a href="{{route("books.create")}}">Add New Book</a>
        </div>
        @endif

        <div class="col-md-12" style="margin-bottom: 50px">
            <form method="get" action="">
                Search : <input type="text" name="filter" value="{{app('request')->input('filter')}}" />
            </form>
        </div>

        <table class="table table-striped table-bordered col-md-12 ">
            <thead>
                <th>Title</th>
                <th>Description</th>
                <th>Book Number</th>
                <th>Autor</th>
            </thead>
            <tbody>
                    @foreach($books as $key=>$book)
                    <tr>
                        <td><h3>{{ $book->title }}</td>
                        <td>{!! $book->description  !!}</td>
                        <td>{!! $book->book_number  !!}</td>
                        <td>{!! $book->author->fullName  !!}</td>
                        @if(Auth::user()->is_librarian)
                        <td><a href="{{route('books.edit', $book->id)}}">Edit</a></td>
                        <td><a class="delete" data-url="{{route("books.destroy", $book->id)}}">Delete</a></td>
                        @endif
                    </tr>
                    @endforeach
                    {{ $books->links() }}
            </tbody>
        </table>
    </div>
</div>
@endsection
