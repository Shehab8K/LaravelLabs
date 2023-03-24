@extends('layouts.app')

@section('title') Update @endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

@if($post)
<form method="post" action="{{route('posts.update', $post->id)}}">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Title</label>
    <input type="text" class="form-control" id="exampleInputEmail1" value="{{$post->title}}"
      aria-describedby="emailHelp" name="title">
  </div>

  <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
      name="description">{{$post->description}}</textarea>
  </div>

  <div class="mb-3">
    <label for="author" class="form-label">Post Creator</label>
    <select class="form-select" aria-label="Default select example" name="post_creator" required>
      @foreach($users as $user)
      @if($user->id == $author->id)
      <option selected value="{{$user->id}}">{{$user->name}}</option>
      @else
      <option value="{{$user->id}}">{{$user->name}}</option>
      @endif
      @endforeach
    </select>
  </div>

  <x-button type="submit" class="primary">Update</x-button>
  <!-- <button type="submit" class="btn btn-success">Update</button> -->
</form>
@endif
@endsection