@extends('frontend.master')
@section('title', 'Home')
@section('content')
    <!-- Start main-content -->
    <div class="main-content mt-80">
        <section>
            <div class="container">
                <div class="section-title">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-10">
                            <form class="form-inline" action="{{ route('postList') }}" method="get">
                                <div class="form-group">
                                    <input type="text" value="{{ request('title') }}" name="title"
                                           style="border-radius: 4px; height:37px; width:300px;"
                                           class="form-control mt-10"
                                           id="" placeholder="Search Blog.....">
                                    <select name="category" class="form-control mt-10"
                                            style="border-radius: 4px; height:37px; width:300px;">
                                        <option value="">All</option>
                                        @foreach ($postCategories as $postCategoriesDatum)
                                            <option @if (request('category') == $postCategoriesDatum->slug) selected
                                                    @endif
                                                    value="{{ $postCategoriesDatum->slug }}">
                                                {{ $postCategoriesDatum->name }}</option>
                                        @endforeach

                                    </select>
                                    <button type="submit" class="btn btn-default mt-10">Search</button>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-6">
                            {{-- <h5 class="font-weight-300 m-0">Let's Join Our Mission, to be a place of hopes.</h5> --}}
                            {{-- <h2 class="mt-0 text-uppercase font-28">Latest <span
                                    class="text-theme-colored font-weight-400">Campaigns</span> <span
                                    class="font-30 text-theme-colored">.</span></h2>
                            <div class="icon">
                                <i class="fa fa-hospital-o"></i>
                            </div> --}}
                            @if ($postList->count())
                                <h2 class="mt-0 text-uppercase font-28">Blogs </h2>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="section-content">
                    <div class="row multi-row-clearfix">
                        <div class="blog-posts">
                            @foreach ($postList as $postListKey => $postListDatum)
                                <div class="col-md-4">
                                    <article class="post clearfix mb-30 bg-lighter">
                                        <div class="entry-header">
                                            <div class="post-thumb thumb">
                                                <img
                                                    src="{{ asset('uploads') . '/' . imageName($postListDatum->image, '-cropped') }}"
                                                    alt="" class="img-responsive img-fullwidth">
                                            </div>
                                        </div>
                                        <div class="entry-content p-20 pr-10">
                                            <div class="entry-meta media mt-0 no-bg no-border">
                                                <div
                                                    class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                                                    <ul>
                                                        <li class="font-16 text-white font-weight-600">
                                                            {{ date('d', strtotime($postListDatum->created_at)) }}</li>
                                                        <li class="font-12 text-white text-uppercase">
                                                            {{ date('M', strtotime($postListDatum->created_at)) }}</li>
                                                    </ul>
                                                </div>
                                                <div class="media-body pl-15">
                                                    <div class="event-content pull-left flip">
                                                        <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a
                                                                href="#">{{ substr($postListDatum->title, 0, 100) }}</a>
                                                        </h4>
                                                        {{-- <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                                class="fa fa-commenting-o mr-5 text-theme-colored"></i> 214
                                                            Comments</span>
                                                        <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                                class="fa fa-heart-o mr-5 text-theme-colored"></i> 895
                                                            Likes</span> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-10"> {!! substr($postListDatum->body, 0, 100) !!}....</p>
                                            <a href="{{ route('postDetailPage', $postListDatum->slug) }}"
                                               class="btn-read-more">Read more</a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                            @if (!$postList->count())
                                <div class="col-md-5">
                                </div>
                                <div class="col-md-6">
                                    <h2 class="font-weight-300 m-0">Data not found.</h2>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <nav>
                                    {{ $postList->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- end main-content -->
@endsection
