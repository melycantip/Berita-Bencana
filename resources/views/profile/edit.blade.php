@extends('layouts.master')

@section('content')
    <div class="container paddding">
        <h1 class="text-primary my-2">Update Profile</h1>
        <form action="/profile/{{ $profile->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="age">Age</label>
                <input id="age" type="number" class="form-control" value="{{ $profile->age }}" name="age">
            </div>
            @error('age')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="form-group">
                <label for="bio">Biodata</label>
                <textarea name="bio" class="form-control" id="bio" cols="10" rows="5">{{ $profile->bio }}</textarea>
            </div>
            @error('bio')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" class="form-control" id="address" cols="30" rows="10">{{ $profile->address }}</textarea>
            </div>
            @error('address')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="form-group">
                <label for="photo_profile">Photo Profile</label>
                <input type="file" name="photo_profile" id="photo_profile" class="form-control">
            </div>
            @error('photo_profile')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
