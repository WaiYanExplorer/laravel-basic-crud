@extends('users.layouts.app')

@section('content')

<div class="container my-5 d-flex flex-column align-items-center">
    <div class="row d-flex flex-column align-items-center">
        <div class="col-6">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
        <div class="col-6">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewPost">
                Add
            </button>
        </div>
        @if ($posts)
            @foreach ($posts as $post)
            <div class="col-6 my-4">
                <div class="card">
                    <div class="card-header">
                        <h3>{{$post->header}}</h3>
                    </div>
                    <div class="card-body">
                        {{$post->description}}
                    </div>
                    <div class="card-footer">
                        <div class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal{{$post->id}}">Edit</div>
                        <div class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal{{$post->id}}">Delete</div>
                    </div>
                </div>
            </div>

            {{-- delete modal --}}
            <div class="modal fade" id="confirmModal{{$post->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Confirmation</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('delete', $post->id)}}" method="post">
                        @csrf
                        <div class="modal-body">
                            Are you sure that you want to delete "{{$post->header}}"?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Yes, I'm sure</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        </div>
                    </form>
                  </div>
                </div>
            </div>

            {{-- edit modal --}}
            <div class="modal fade" id="editModal{{$post->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Post</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('update', $post->id)}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                            <label for="header" class="form-label">Post Header</label>
                            <input type="text" name="header" class="form-control" id="header" value="{{$post->header}}">
                            </div>
                            <div class="mb-3">
                            <label for="description" class="form-label">Post Description</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{$post->description}}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>

{{-- Add new post --}}
<!-- Modal -->
<div class="modal fade" id="addNewPost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Post</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('add')}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                <label for="header" class="form-label">Post Header</label>
                <input type="text" name="header" class="form-control" id="header">
                </div>
                <div class="mb-3">
                <label for="description" class="form-label">Post Description</label>
                <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection
