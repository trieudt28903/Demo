@extends('admin.layout.master')

@section('title')
    Post Add
@endsection

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
                    <form action="{{route('admin.post.store')}}" method="POST" enctype="multipart/form-data" ">
                        @csrf
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category_id">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" name="title" placeholder="Please Enter Title" />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input class="form-control" name="description" placeholder="Please Enter Description" />
                        </div>
                        <div class="form-group">
                            <label>New Post</label>
                            <input type="checkbox"  name="new_post"  />
                        </div>
                        <div class="form-group">
                            <label>Highlight Post</label>
                            <input type="checkbox" name="highlight_post"  id="">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file"  name="image" class="form-control" id="yourFileInputId">

                        </div>
                        <div class="form-group">
                            <label for="demo">Content:</label>
                            <textarea name="content" class="form-control" id="demo" cols="30" rows="10"></textarea>
                        </div>


                        <button type="submit" class="btn btn-default">Category Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
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
