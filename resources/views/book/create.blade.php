@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Book') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('books.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                       name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                       name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>

                                @error('description')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="book_number" class="col-md-4 col-form-label text-md-end">{{ __('Book Number') }}</label>

                            <div class="col-md-6">
                                <input id="book_number" type="text" class="form-control @error('book_number') is-invalid @enderror"
                                       name="book_number" value="{{ old('book_number') }}" required autocomplete="book_number" autofocus>

                                @error('book_number')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="author" class="col-md-4 col-form-label text-md-end">{{ __('Author') }}</label>

                            <div class="col-md-6">
                                <select id="author" name="author_id"  class="form-control @error('author_id') is-invalid @enderror">
                                    @foreach($authors as $author)
                                        <option value="{{$author->id}}">{{$author->fullName}}</option>
                                    @endforeach
                                </select>
                                @error('author_id')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
