@extends('admin.layout.master')


@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Post
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="{{route('admin.post.update',$post->id)}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($post->category_id==$category->id) selected @endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" name="title" value="{{$post->title}}" placeholder="Please Enter Title" />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input class="form-control" name="description" value="{{$post->description}}" placeholder="Please Enter Description" />
                    </div>
                    <div class="form-group">
                        <label>New Post</label>
                        <input type="checkbox" @if($post->new_post) checked @endif name="new_post" />

                    </div>
                    <div class="form-group">
                        <label>Highlight Post</label>
                        <input type="checkbox" value="1" {{$post->highlight_post==1 ? 'checked': ''}} name="highlight_post"  id="">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <!-- Display current file name -->
                        <h5>Ảnh đang dùng là : {{ $post->image }}</h5>

                        <!-- File input for updating -->
                        <input type="file" name="image" class="form-control" id="">



                    </div>
                    <div class="form-group">
                        <label for="demo">Content:</label>
                        <textarea name="content" class="form-control"  id="demo" cols="30" rows="10">{{$post->content}}</textarea>
                    </div>


                    <button type="submit" class="btn btn-default">Post Update</button>

                    <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </div>
@endsection
