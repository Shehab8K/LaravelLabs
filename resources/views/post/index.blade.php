@extends('layouts.app')


@section('title') Index @endsection

@section('content')
<div class="text-center">
    <a href="{{route('posts.create')}}" class="mt-4 btn btn-success">Create Post</a>
</div>
<table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if($posts)
        @foreach($posts as $post)
        <tr>
            <td>{{$post['id']}}</td>
            <td>{{$post['title']}}</td>
            <td>{{$post->user->name}}</td>
            <td>{{$post['created_at_formatted']}}</td>
            <td>

                <a href="{{route('posts.show', $post['id'])}}" class="btn btn-info">View</a>
                <a href="{{route('posts.edit', $post['id'])}}" class="btn btn-primary">Edit</a>

                <form action="{{route('posts.destroy', $post->id)}}" method="post" class="d-inline">
                    @csrf
                    @method("Delete")
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmModal{{ $post->id }}">Delete</button>

                    <div class="modal fade" id="confirmModal{{ $post->id }}" tabindex="-1"
                        aria-labelledby="confirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    Are you sure you want to delete this post
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


            </td>
        </tr>
        @endforeach
        @endif

        @if($update)
        <div id="updateMsg" class="alert alert-success">Updated Successfully</div>
        @endif

        @if($delete)
        <div id="deleteMsg" class="alert alert-success">Deleted Successfully</div>
        @endif
    </tbody>
</table>

<div class="offset-3 col-6 mt-4">{{ $postLinks->links() }}</div>


<script>
    const updateMsg = document.getElementById("updateMsg");
    const deleteMsg = document.getElementById("deleteMsg");
    window.addEventListener('load', function() {
        setTimeout(function() {
            updateMsg.remove();
        }, 1500);

        setTimeout(function() {
            deleteMsg.remove();
        }, 1500);
    });
</script>

@endsection