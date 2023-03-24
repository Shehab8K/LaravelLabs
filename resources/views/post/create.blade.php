@extends('layouts.app')

@section('title') Create @endsection

@section('content')

<form method="post" action="{{route('posts.store')}}">
  @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Title</label>
    <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  </div>

  <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
    <textarea class="form-control" title="description" id="exampleFormControlTextarea1" rows="3" required
      name="description"></textarea>
  </div>

  <div class="mb-3">
    <label for="author" class="form-label">Post Creator</label>
    <select class="form-select" aria-label="Default select example" name="post_creator" required>
      <option disabled>Choose Author</option>
      @if($users)
      @foreach($users as $user)
      <option value="{{$user->id}}">{{$user->name}}</option>
      @endforeach
      @endif
    </select>
  </div>

  <x-button type="submit" class="success">ٍSubmit</x-button>
  <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
</form>

@endsection