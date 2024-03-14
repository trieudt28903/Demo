@extends('admin.layout.master')


@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Post
                        <small>List</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Highlight post</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                    <tr class="odd gradeX" align="center">
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td><img style="height: 120px; width: 50%;" src="{{$post->imageURL()}}"></td>
                        <td>{{$post->category->name}}</td>
                        <td>{{$post->highlight_post==1?"x":""}}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{route('admin.post.delete',$post->id)}}"> Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{route('admin.post.edit',$post->id)}}">Edit</a></td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            {!! $posts->links() !!}
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
