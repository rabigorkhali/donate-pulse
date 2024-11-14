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
                    <h5 class="widget-title line-bottom">Latest Campaigns</h5>
                    <div class="latest-campaigns">
                        @foreach (getLatestCampaigns(3) as $keyCampaignsFooter => $getLatestCampaignsDatum)
                            <article class="post media-post clearfix pb-0 mb-10">
                                <a href="{{ route('campaignDetailPage', $getLatestCampaignsDatum->slug) }}"
                                   class="post-thumb">
                                    @if ($getLatestCampaignsDatum->cover_image)
                                        <img height="55" width="85" alt=""
                                             src="{{ asset( imageName($getLatestCampaignsDatum->cover_image, '-small')) }}">
                                    @else
                                        <img height="55" width="85" alt=""
                                             src="{{ imageName($getLatestCampaignsDatum->cover_image) }}">
                                    @endif
                                    {{-- <img alt="" src="80x55.png"> --}}
                                </a>
                                <div class="post-right">
                                    <a href="{{ route('campaignDetailPage', $getLatestCampaignsDatum->slug) }}">
                                        <h5 class="post-title mt-0 mb-5"><a
                                                href="{{ route('campaignDetailPage', $getLatestCampaignsDatum->slug) }}">{{ substr($getLatestCampaignsDatum->title, 0, 30) }}</a>
                                        </h5>
                                        <p class="post-date mb-0 font-12">
                                            {{ $getLatestCampaignsDatum?->created_at?->format('M j, Y') }}</p>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
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
                                             src="{{ asset(imageName($getPostsBlogsDatum->image, '-small')) }}">
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
                            <a href="{{ route('frontendPage', 'faq') }}">FAQ</a>
                        </li>
                        <li>
                            <a href="{{ route('frontendPage', 'how-it-works') }}">How to get donation</a>
                        </li>
                        <li>
                            <a href="{{ route('campaignList') }}">Make Donate</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">Get Create New Account</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark mb-20">
                    <h5 class="widget-title line-bottom">Quick Contact</h5>
                    <ul class="list-border font-13">
                        <li><a href="#">{{  getConfigTableData()?->primary_phone_number }}</a></li>
                        <li><a href="#">{{  getConfigTableData()?->email }}</a></li>
                        <li><a href="#" class="lineheight-20">{{  getConfigTableData()?->address_line_1 }}</a></li>
                    </ul>
                </div>
                <div class="widget dark">
                    <h6 class="widget-title mb-0 text-gray-darkgray">Connect With Us</h6>
                    <ul class="social-icons icon-dark icon-circled icon-sm mt-10">
                        <li><a target="_blank" href="{{  getConfigTableData()?->facebook_url }}"><i
                                        class="fa fa-facebook"></i></a></li>
                        <li><a target="_blank" href="{{  getConfigTableData()?->twitter_url }}"><i
                                        class="fa fa-twitter"></i></a></li>
                        <li><a target="_blank" href="{{  getConfigTableData()?->instagram_url }}"><i
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
                    <p class="font-11 text-black-777 m-0">{{  getConfigTableData()?->all_rights_reserved_text }}</p>
                </div>
                <div class="col-md-6 text-right">
                    <div class="widget no-border m-0">
                        <ul class="list-inline sm-text-center mt-5 font-12">
                            <li>
                                <a href="{{ route('frontendPage', 'faq') }}">FAQ</a>
                            </li>
                            <li>|</li>
                            <li>
                                <a href="{{ route('frontendContactus') }}">Help Desk</a>
                            </li>
                            <li>|</li>
                            <li>
                                <a href="{{ route('frontendPage', 'privacy-policies') }}">Privacy Policies</a>
                            </li>
                            <li>|</li>
                            <li>
                                <a href="{{ route('campaignList') }}">Donate</a>
                            </li>
                            <li>|</li>
                            <li>
                                <a href="{{ route('campaigns.create') }}">Get Donation</a>
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
