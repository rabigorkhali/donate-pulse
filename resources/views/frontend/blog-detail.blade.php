@extends('frontend.master')
@section('header')
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
@endsection
@section('title', 'Home')
@section('content')
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-stellar-background-ratio="0.5"
                 data-bg-img="{{ asset('uploads') . '/' . $postDetails->image }}"
                 style="background-image: url(&quot;images/bg/bg1.jpg&quot;); background-position: 50% 61px;">
            <div class="container pt-100 pb-50">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">

                            <h3 class="title text-white">{{ $postDetails->title }}</h3>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container mt-30 mb-30 pt-30 pb-30">
                <div class="row">
                    <div class="col-md-9 pull-right flip sm-pull-none">
                        <div class="blog-posts single-post">
                            <article class="post clearfix mb-0">
                                <div class="entry-header">
                                    <div class="post-thumb thumb"><img
                                                src="{{ asset('uploads') . '/' . $postDetails->image }}" alt=""
                                                class="img-responsive img-fullwidth"></div>
                                </div>
                                <div class="entry-content">
                                    <div class="entry-meta media no-bg no-border mt-15 pb-20">
                                        <div
                                                class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                                            <ul>
                                                <li class="font-16 text-white font-weight-600">
                                                    {{ date('d', strtotime($postDetails->created_at)) }}</li>
                                                <li class="font-12 text-white text-uppercase">
                                                    {{ date('M', strtotime($postDetails->created_at)) }}</li>
                                            </ul>
                                        </div>
                                        <div class="media-body pl-15">
                                            <div class="event-content pull-left flip">
                                                <h4 class="entry-title text-white text-uppercase m-0"><a
                                                            href="#">{{ $postDetails->title }}</a></h4>
                                                {{--  <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                        class="fa fa-commenting-o mr-5 text-theme-colored"></i> 214
                                                    Comments</span>
                                                <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                        class="fa fa-heart-o mr-5 text-theme-colored"></i> 895 Likes</span> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-15">
                                        {!! $postDetails->body !!}
                                    </p>


                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="sidebar sidebar-left mt-sm-30">
                            <div class="widget">
                                <h5 class="widget-title line-bottom">Search box</h5>
                                <div class="search-form">
                                    <form class="form-inline" action="{{ route('postList') }}" method="get">
                                        <div class="input-group">
                                            <input type="text" name="title" placeholder="Click to Search"
                                                   class="form-control search-input">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn search-button"><i
                                                            class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="widget">
                                <h5 class="widget-title line-bottom">Categories</h5>
                                <div class="categories">
                                    <ul class="list list-border angle-double-right">
                                        @foreach ($postCategories as $postCategoriesKey => $postCategoriesDatum)
                                            <li><a
                                                        href="{{ route('postList', ['category' => $postCategoriesDatum->slug]) }}">{{ $postCategoriesDatum->name }}
                                                    <span>({{ $postCategoriesDatum->posts->count() }})</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="widget">
                                <h5 class="widget-title line-bottom">Latest Blogs</h5>
                                <div class="latest-posts">
                                    <article class="post media-post clearfix pb-0 mb-10">
                                        <ul>

                                            @foreach ($latestPosts as $latestPostsKey => $latestPostsDatum)
                                                <li>
                                                    <div class="post-right">
                                                        <h5 class="post-title mt-0">
                                                            <a
                                                                    href="{{ route('postDetailPage', ['slug' => $latestPostsDatum->slug]) }}">{{ $latestPostsDatum->title }}</a>
                                                        </h5>
                                                </li>
                                            @endforeach
                                        </ul>

                                    </article>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>

    </div>
@endsection
