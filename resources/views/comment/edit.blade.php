@extends('layouts.app')

@section('title') Update @endsection

@section('content')

@if($comment)
<form method="post" action="{{route('comments.update', $comment->id)}}">
    @csrf
    @method('PUT')
    <input type="hidden" name="commentable_type" value="App\Models\Post">

    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment"
            required>{{$comment->comment}}</textarea>
    </div>

    <div class="mb-3">
        <label for="author" class="form-label">Comment Creator</label>
        <select class="form-select" aria-label="Default select example" name="user_id" required>
            @foreach($users as $user)
            @if($user->id == $comment->user->id)
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