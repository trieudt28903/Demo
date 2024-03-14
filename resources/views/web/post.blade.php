@extends('web.layout.master')
@section('content')
<section class="section single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-title-area">
                        <ol class="breadcrumb hidden-xs-down">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/category">Blog</a></li>
                            <li class="breadcrumb-item active">{{$post->title}}</li>
                        </ol>

                        <span class="color-orange"><a href="{{route('web.category',$post->category->slug)}}" title="">{{$post->category->name}}</a></span>

                        <h3>{{$post->title}}</h3>

                        <div class="blog-meta big-meta">
                            <small>{{\Carbon\Carbon::parse($post->created_at)->format('d-m-Y')}}</small>
                            <small>{{$post->user->name}}</small>
                        </div><!-- end meta -->
                    </div><!-- end blog-title-area -->

                    <div class="single-post-media">
                        <img src="{{$post->imageURL()}}" alt="" class="img-fluid">
                    </div><!-- end single-post-media -->

                    <div class="blog-content">
                        <div class="pp">
                            <p>{{$post->description}}</p>
                            <p>{!! $post->content !!}</p>
                        </div><!-- end pp -->

                        <hr class="invis1">

                        <div class="custombox clearfix">
                            <h4 class="small-title">You may also like</h4>
                            <div class="row">
                                @foreach($relate as $relatedPost)
                                    <div class="col-lg-6">
                                        <div class="blog-box">
                                            <div class="post-media">
                                                <a href="{{ route('web.post', $relatedPost->slug) }}" title="">
                                                    <img src="{{ $relatedPost->imageURL() }}" alt="" class="img-fluid">
                                                    <div class="hovereffect">
                                                        <span class=""></span>
                                                    </div><!-- end hovereffect -->
                                                </a>
                                            </div><!-- end post-media -->

                                            <div class="blog-meta">
                                                <h4><a href="{{ route('web.post', $relatedPost->slug) }}" title="">{{ $relatedPost->title }}</a></h4>
                                                <small><a href="{{ route('web.category', $relatedPost->category->slug) }}" title="">{{ $relatedPost->category->name }}</a></small>
                                                <small>{{ \Carbon\Carbon::parse($relatedPost->created_at)->format('d-m-Y') }}</small>
                                            </div><!-- end blog-meta -->
                                        </div><!-- end blog-box -->
                                    </div><!-- end col -->
                                @endforeach
                            </div><!-- end row -->
                        </div><!-- end custombox -->

                        <hr class="invis1">
                        @if(\Illuminate\Support\Facades\Auth::check())
                        <div class="custombox clearfix">
                            <h4 class="small-title">Leave a Reply</h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Comment Form -->
                                    <form class="form-wrapper" method="post" action="{{route('web.post.comment',$post->id)}}">
                                        @csrf
                                        <div class="form-group">
                                            <textarea class="form-control" name="content" placeholder="Your comment"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                                    </form>
                                </div>
                            </div>
                        </div><!-- end custombox -->
                        @endif
                        <!-- Comment Section -->
                        <div class="custombox clearfix">
                            <h4 class="small-title">{{$post->comments->count()}} Comments</h4>
                            <!-- Loop through comments and display them -->
                            @foreach($post->comments as $comment)
                                <div class="media">

                                    <div class="media-body">
                                        <h6 class="mt-0">{{ $comment->user->name }}</h6>
                                        <p>{{ $comment->content }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div><!-- end custombox -->
                    </div><!-- end blog-content -->
                </div><!-- end page-wrapper -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@endsection
