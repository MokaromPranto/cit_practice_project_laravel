@extends('dashboard.dashboard-master')

@section('page_title')
Post List
@endsection()


@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('post.create') }}">Post</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('post.index') }}">Post List</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h3>List of Posts</h3>
            </div>
            @if (session('success'))
                <div class="alert alert-primary">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('soft_delete_msg'))
                <div class="alert alert-info">
                    {{ session('soft_delete_msg') }}
                </div>
            @endif
            @if (session('post_hard_del_msg'))
                <div class="alert alert-danger">
                    {{ session('post_hard_del_msg') }}
                </div>
            @endif
            @if (session('post_restore_success'))
                <div class="alert alert-success">
                    {{ session('post_restore_success') }}
                </div>
            @endif
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-inverse">
                        <tr>
                            <th><h4>Post Image</h4></th>
                            <th><h4>Post Title</h4></th>
                            <th><h4>Action</h4></th>
                        </tr>
                    </thead>
                        <tbody>
                            @forelse ($posts as $post)
                            <tr>
                                <td>
                                    <img class="w-25" src="{{ asset('uploads/post_img') }}/{{ $post->post_image }}" alt="not found">
                                </td>
                                <td>{{ $post->post_title }}</td>
                                <td>
                                    <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-warning text-white">Move to Bin</button>
                                    </form>
                                    <form action="{{ route('post.hard.delete', $post->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hard Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr class="text-center text-danger">
                                <td colspan="50">No Posts to Show</td>
                            </tr>
                            @endforelse
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h3>Post Recycle Bin</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="thead-inverse">
                        <tr>
                            <th><h4>Post Image</h4></th>
                            <th><h4>Post Title</h4></th>
                            <th><h4>Action</h4></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($deleted_posts as $deleted_post)
                        <tr>
                            <td>
                                <img class="w-25" src="{{ asset('uploads/post_img') }}/{{ $deleted_post->post_image }}" alt="not found">
                            </td>
                            <td>{{ $deleted_post->post_title }}</td>
                            <td>
                            <a href="{{ route('post.restore', $deleted_post->id) }}" class="btn btn-success btn-sm">Restore</a>
                            </td>
                        </tr>
                        @empty
                        <tr class="text-center text-danger">
                            <td colspan="50">Recycle Bin is Empty</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

