@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="form mt-5 mx-auto w-50">
                <h1 class="text-center mt-5">Add New Post</h1>
                <form action="{{route('post.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="description">Content</label>
                        <textarea class="form-control" id="description" name="content" rows="3" placeholder="Enter content"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success w-100">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
