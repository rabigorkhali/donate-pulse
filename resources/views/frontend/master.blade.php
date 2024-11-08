@include('frontend.partials.header')

<body class="">
@include('frontend.partials.loader')
@include('frontend.partials.navbar')
@yield('content')
<div id="wrapper" class="clearfix">
    <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
</div>
<footer id="footer" class="footer bg-black-222">
    <div class="container pt-70 pb-30">
        <div class="row border-bottom-black">
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <img class="mt-10 mb-20" alt=""
                         src="html/2016/charitypress-html/demo/images/logo-wide-white.png">
                    <p>{{  getConfigTableData()->address_line_1 }}</p>
                    <ul class="list-inline mt-5">
                        <li class="m-0 pl-10 pr-10"><i class="fa fa-phone text-theme-colored mr-5"></i> <a
                                    class="text-gray" href="#">{{ getConfigTableData()->mobile_number }}</a></li>
                        <li class="m-0 pl-10 pr-10"><i class="fa fa-envelope-o text-theme-colored mr-5"></i> <a
                                    class="text-gray" href="#">{{  getConfigTableData()->email }}</a></li>
                        <li class="m-0 pl-10 pr-10"><i class="fa fa-globe text-theme-colored mr-5"></i> <a
                                    class="text-gray" href="#">www.donatepur.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h5 class="widget-title line-bottom">Latest Blogs</h5>
                    <div class="latest-posts">
                        @foreach (getPostsBlogs(3) as $keyBlogFooter => $getPostsBlogsDatum)
                            <article class="post media-post clearfix pb-0 mb-10">
                                <a href="#" class="post-thumb">
                                    @if ($getPostsBlogsDatum->image)
                                        <img height="55" width="85" alt=""
                                             src="{{ asset('/uploads/') . '/' . imageName($getPostsBlogsDatum->image, '-small') }}">
                                    @else
                                        <img height="55" width="85" alt=""
                                             src="{{ imageName($getPostsBlogsDatum->image) }}">
                                    @endif
                                    {{-- <img alt="" src="80x55.png"> --}}
                                </a>
                                <div class="post-right">
                                    <h5 class="post-title mt-0 mb-5"><a
                                                href="#">{{ $getPostsBlogsDatum->title }}</a></h5>
                                    <p class="post-date mb-0 font-12">
                                        {{ $getPostsBlogsDatum->created_at->format("M j, Y") }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h5 class="widget-title line-bottom">Useful Links</h5>
                    <ul class="list angle-double-right list-border">
                            <li>
                                <a target="_blank"
                                   href="dfgdfg">dfgdfgdfg}</a>
                            </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark mb-20">
                    <h5 class="widget-title line-bottom">Quick Contact</h5>
                    <ul class="list-border font-13">
                        <li><a href="#">{{  getConfigTableData()->mobile_number }}</a></li>
                        <li><a href="#">{{  getConfigTableData()->email }}</a></li>
                        <li><a href="#" class="lineheight-20">{{  getConfigTableData()->address_line_1 }}</a></li>
                    </ul>
                </div>
                <div class="widget dark">
                    <h6 class="widget-title mb-0 text-gray-darkgray">Connect With Us</h6>
                    <ul class="social-icons icon-dark icon-circled icon-sm mt-10">
                        <li><a target="_blank" href="{{  getConfigTableData()->facebook_url }}"><i
                                        class="fa fa-facebook"></i></a></li>
                        <li><a target="_blank" href="{{  getConfigTableData()->twitter_url }}"><i
                                        class="fa fa-twitter"></i></a></li>
                        <li><a target="_blank" href="{{  getConfigTableData()->instagram_url }}"><i
                                        class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <div class="footer-bottom bg-black-333">
        <div class="container pt-20 pb-20">
            <div class="row">
                <div class="col-md-6 sm-text-center">
                    <p class="font-11 text-black-777 m-0">{{  getConfigTableData()->all_rights_reserved_text }}</p>
                </div>
                <div class="col-md-6 text-right">
                    <div class="widget no-border m-0">
                        <ul class="list-inline sm-text-center mt-5 font-12">
                            <li>
                                <a href="">FAQ</a>
                            </li>
                            <li>|</li>
                            <li>
                                <a href="">Help Desk</a>
                            </li>
                            <li>|</li>
                            <li>
                                <a href="">Donate</a>
                            </li>
                            <li>|</li>
                            <li>
                                <a href="">Get Donation</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
@include('frontend.partials.footer')
