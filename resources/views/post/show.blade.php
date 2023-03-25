@extends('layouts.app')

@section('title') Show @endsection

@section('content')
@if($post)
<div class="card mt-5">
    <div class="card-header">
        Post Info
    </div>
    <div class="card-body">
        <div>
            <h5 class="card-title d-inline">Title: {{$post->title}} </h5>
            <span style="float: right;">Created At :
                {{$post->created_at_formatted}}</span>
        </div>
        <p class="card-text mt-3">Description: {{$post->description}}</p>
        <p class="card-text">Author: {{$user->name}}</p>
    </div>

    <!-- Comment Section -->
    <div class="card-footer">
        <?php
        $comments = $post->comments;
        ?>
        @foreach($comments as $comment)
        <div class="display-comment mt-3">
            <strong>{{ $comment->user->name }}</strong>
            <p>{{ $comment->comment }}</p>

            <a href="{{route('comments.edit', $comment->id )}}" class="btn btn-primary">Edit</a>

            <form action="{{route('comments.destroy', $comment->id )}}" method="post" class="d-inline">
                @csrf
                @method("Delete")
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
        <hr />
        @endforeach

        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group">
                <input type="hidden" name="commentable_id" value="{{ $post->id }}">
                <input type="hidden" name="commentable_type" value="App\Models\Post">
                <textarea name="comment" rows="3" class="form-control" required></textarea>
                <img src="{{ asset($post->image_path) }}" alt="Post Image">
                <select class="form-select" aria-label="Default select example" name="user_id" required>
                    <option value="{{$users[0]->id}}">{{$users[0]->name}}</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-2">
                <input type="submit" class="btn btn-success" value="Comment" />
            </div>
        </form>
    </div>
</div>
@endif


@endsection