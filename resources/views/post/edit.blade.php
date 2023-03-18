@extends('layouts.app')

@section('title') Update @endsection

@section('content')

<form method="post" action="{{route('posts.store')}}">
    @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Title</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>

    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>

  <div class="mb-3">
    <label for="author" class="form-label">Post Creator</label>
    <input type="text" class="form-control" id="author" aria-describedby="emailHelp">
  </div>
  <x-button type="submit" class="primary">Update</x-button>
  <!-- <button type="submit" class="btn btn-success">Update</button> -->
</form>

@endsection
