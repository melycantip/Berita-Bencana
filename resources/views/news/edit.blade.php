@extends('layouts.master')

@section('content')
    <div class="container paddding">
        <h1 class="text-primary my-2">Update News</h1>
        <form action="/news/{{ $news->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" value="{{ $news->title }}" id="title" name="title">
            </div>
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" cols="30" rows="10">{{ $news->content }}</textarea>
            </div>
                @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Select a Categories</option>
                            @forelse ($categories as $item)
                            @if ($item->id === $news->category_id)
                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                            @else
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endif
                            @empty
                            <option value="">No Catagories</option>
                            @endforelse
                </select>
            </div>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" class="form-control" id="thumbnail" name="thumbnail">
            </div>
                @error('thumbnail')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
