@extends('web.layout.master')

<section class="section first-section">
    <div class="container-fluid">
        <div class="row">
            @foreach($highlight as $post)
                <div class="col-lg-4">
                    <div class="card" style="width: 18rem;">
                        <img src="{{$post->imageURL()}}"  alt="" class="card-img-top img-fluid">
                        <div class="card-body">
                            <span class="badge bg-orange"><a href="{{route('web.category',$post->category->slug)}}" class="text-white" title="">{{$post->category->name}}</a></span>
                            <h4 class="card-title mt-2"><a href="{{route('web.post',$post->slug)}}" title="">{{ $post->title }}</a></h4>
                            <div class="blog-meta">
                                <small>{{\Carbon\Carbon::parse($post->created_at)->format('d-m-Y')}}</small>
                                <small>{{$post->user->name}}</small>
                                <br>
                                <small>view: {{$post->view_counts}}</small>
                            </div><!-- end meta -->
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            @endforeach
        </div><!-- end row -->
    </div><!-- end container-fluid -->
</section>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-wrapper">
                    <div class="blog-top clearfix">
                        <h4 class="pull-left">Recent News</h4>
                    </div><!-- end blog-top -->
                    @foreach($new as $post)
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <img src="{{$post->imageURL()}}" alt="" class="card-img-top img-fluid">
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title mt-2"><a href="{{route('web.post',$post->slug)}}" title="">{{ $post->title }}</a></h4>
                                    <p class="card-text">{{$post->description}}</p>
                                    <div class="blog-meta">
                                        <small class="firstsmall"><a href="{{route('web.post',$post->category->slug)}}" class="bg-orange text-white" title="">{{$post->category->name}}</a></small>
                                        <br>
                                        <small>{{\Carbon\Carbon::parse($post->created_at)->format('d-m-Y')}}</small>
                                        <small>{{$post->user->name}}</small>
                                        <br>
                                        <small>view: {{$post->view_counts}}</small>
                                    </div><!-- end meta -->
                                </div><!-- end card-body -->
                            </div><!-- end col -->
                        </div><!-- end row -->
                        <hr class="invis">
                    @endforeach
                </div><!-- end page-wrapper -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
