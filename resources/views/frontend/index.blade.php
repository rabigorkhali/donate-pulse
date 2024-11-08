@extends('frontend.master')
@section('title', 'Home')
@section('content')
    <!-- Start main-content -->
    <div class="main-content">
        <!-- Section: home -->
        <section id="home">
            <div class="container-fluid p-0">
                <!-- Slider Revolution Start -->
                <div class="rev_slider_wrapper">
                    <div class="rev_slider" data-version="5.0">
                        <ul>
                            <?php $islider = 1; ?>
                            @foreach ($sliderBanners as $sliderBannersKey => $sliderBannersDatum)
                                @if ($islider % 2 === 0)
                                    <li data-index="rs-2" data-transition="slidingoverlayhorizontal"
                                        data-slotamount="default"
                                        data-easein="default" data-easeout="default" data-masterspeed="default"
                                        data-thumb="{{ asset('uploads') . '/' . imageName($sliderBannersDatum->cover_image, '-small') }}"
                                        data-rotate="0" data-saveperformance="off" data-title="Slide 2"
                                        data-description="">
                                        <!-- MAIN IMAGE -->
                                        <img
                                            src="{{ asset('uploads') . '/' . imageName($sliderBannersDatum->cover_image, '-cropped') }}"
                                            alt="" data-bgposition="center center" data-bgfit="cover"
                                            data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="10"
                                            data-no-retina>
                                        <!-- LAYERS -->
                                        <!-- LAYER NR. 1 -->
                                        <div class="tp-caption tp-resizeme text-uppercase text-white font-raleway"
                                             id="rs-2-layer-1" data-x="['left']" data-hoffset="['30']"
                                             data-y="['middle']"
                                             data-voffset="['-110']" data-fontsize="['110']" data-lineheight="['120']"
                                             data-width="none" data-height="none" data-whitespace="nowrap"
                                             data-transform_idle="o:1;s:500"
                                             data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                             data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                             data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                             data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000"
                                             data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                             style="z-index: 7; white-space: nowrap; font-weight:700;">Donate
                                        </div>
                                        <!-- LAYER NR. 2 -->
                                        <div
                                            class="tp-caption tp-resizeme text-uppercase text-white font-raleway bg-theme-colored-transparent pl-20 pr-20"
                                            id="rs-2-layer-2" data-x="['left']" data-hoffset="['35']"
                                            data-y="['middle']"
                                            data-voffset="['-25']" data-fontsize="['35']" data-lineheight="['54']"
                                            data-width="none" data-height="none" data-whitespace="nowrap"
                                            data-transform_idle="o:1;s:500"
                                            data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                            data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                            data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                            data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000"
                                            data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                            style="z-index: 7; white-space: nowrap; font-weight:600; border-radius: 30px;">
                                            {{ $sliderBannersDatum->title }}
                                        </div>
                                        <!-- LAYER NR. 3 -->
                                        <div class="tp-caption tp-resizeme text-white" id="rs-2-layer-3"
                                             data-x="['left']"
                                             data-hoffset="['35']" data-y="['middle']" data-voffset="['30']"
                                             data-fontsize="['16']" data-lineheight="['28']" data-width="none"
                                             data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;s:500"
                                             data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                             data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                             data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                             data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1400"
                                             data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                             style="z-index: 5; white-space: nowrap; letter-spacing:0px; font-weight:400;">
                                            {{ substr($sliderBannersDatum->description, 0, 50) }} <br>
                                            {{ substr($sliderBannersDatum->description, 51, 100) }} <br>
                                            {{ substr($sliderBannersDatum->description, 101, 150) }}....
                                        </div>
                                        <!-- LAYER NR. 4 -->
                                        <div class="tp-caption tp-resizeme" id="rs-2-layer-4" data-x="['left']"
                                             data-hoffset="['35']" data-y="['middle']" data-voffset="['95']"
                                             data-width="none" data-height="none" data-whitespace="nowrap"
                                             data-transform_idle="o:1;"
                                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                             data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                                             data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1400"
                                             data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                             style="z-index: 5; white-space: nowrap; letter-spacing:1px;"><a
                                                class="btn btn-colored btn-lg btn-theme-colored pl-20 pr-20"
                                                href="#">{{ $sliderBannersDatum->btn_text ?? 'Donate Now' }}</a>
                                        </div>
                                    </li>
                                @else
                                    <!-- SLIDE 3 -->
                                    <li data-index="rs-3" data-transition="slidingoverlayhorizontal"
                                        data-slotamount="default" data-easein="default" data-easeout="default"
                                        data-masterspeed="default"
                                        data-thumb="{{ asset('uploads') . '/' . imageName($sliderBannersDatum->cover_image, '-small') }}"
                                        data-rotate="0" data-saveperformance="off" data-title="Slide 3"
                                        data-description="">
                                        <!-- MAIN IMAGE -->
                                        <img
                                            src="{{ asset('uploads') . '/' . imageName($sliderBannersDatum->cover_image, '-cropped') }}"
                                            alt="" data-bgposition="center center" data-bgfit="cover"
                                            data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="10"
                                            data-no-retina>
                                        <!-- LAYERS -->
                                        <!-- LAYER NR. 1 -->
                                        <div
                                            class="tp-caption tp-resizeme text-uppercase text-white font-raleway bg-theme-colored-transparent pr-20 pl-20"
                                            id="rs-3-layer-1" data-x="['right']" data-hoffset="['30']"
                                            data-y="['middle']" data-voffset="['-90']" data-fontsize="['64']"
                                            data-lineheight="['72']" data-width="none" data-height="none"
                                            data-whitespace="nowrap" data-transform_idle="o:1;s:500"
                                            data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                            data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                            data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                            data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000"
                                            data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                            style="z-index: 7; white-space: nowrap; font-weight:600;">
                                            {{-- <span class="">Help</span> The Poor --}}
                                            <span class="">{{ $sliderBannersDatum->title }}</span>
                                        </div>
                                        <!-- LAYER NR. 2 -->
                                        <div class="tp-caption tp-resizeme text-uppercase text-white font-raleway"
                                             id="rs-3-layer-2" data-x="['right']" data-hoffset="['35']"
                                             data-y="['middle']" data-voffset="['-25']" data-fontsize="['32']"
                                             data-lineheight="['54']" data-width="none" data-height="none"
                                             data-whitespace="nowrap" data-transform_idle="o:1;s:500"
                                             data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                             data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                             data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                             data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000"
                                             data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                             style="z-index: 7; white-space: nowrap; font-weight:600;">
                                            {{ $sliderBannersDatum->sub_title }}
                                        </div>
                                        <!-- LAYER NR. 3 -->
                                        <div class="tp-caption tp-resizeme text-white text-right" id="rs-3-layer-3"
                                             data-x="['right']" data-hoffset="['35']" data-y="['middle']"
                                             data-voffset="['30']" data-fontsize="['16']" data-lineheight="['28']"
                                             data-width="none" data-height="none" data-whitespace="nowrap"
                                             data-transform_idle="o:1;s:500"
                                             data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                             data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                             data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                             data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1400"
                                             data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                             style="z-index: 5; white-space: nowrap; letter-spacing:0px; font-weight:400;">
                                            {{ substr($sliderBannersDatum->description, 0, 50) }} <br>
                                            {{ substr($sliderBannersDatum->description, 51, 100) }} <br>
                                            {{ substr($sliderBannersDatum->description, 101, 150) }}....
                                        </div>
                                        <!-- LAYER NR. 4 -->
                                        <div class="tp-caption tp-resizeme" id="rs-3-layer-4" data-x="['right']"
                                             data-hoffset="['35']" data-y="['middle']" data-voffset="['95']"
                                             data-width="none" data-height="none" data-whitespace="nowrap"
                                             data-transform_idle="o:1;"
                                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                             data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                                             data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1400"
                                             data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                             style="z-index: 5; white-space: nowrap; letter-spacing:1px;"><a
                                                class="btn btn-colored btn-lg btn-flat btn-theme-colored pl-20 pr-20"
                                                href="#">{{ $sliderBannersDatum->btn_text ?? 'Donate Now' }}</a>
                                        </div>
                                    </li>
                                @endif
                                    <?php $islider = $islider + 1; ?>
                            @endforeach
                        </ul>
                    </div>
                    <!-- end .rev_slider -->
                </div>
                <!-- end .rev_slider_wrapper -->
                <script>
                    $(document).ready(function (e) {
                        $(".rev_slider").revolution({
                            sliderType: "standard",
                            sliderLayout: "auto",
                            dottedOverlay: "none",
                            delay: 5000,
                            navigation: {
                                keyboardNavigation: "off",
                                keyboard_direction: "horizontal",
                                mouseScrollNavigation: "off",
                                onHoverStop: "off",
                                touch: {
                                    touchenabled: "on",
                                    swipe_threshold: 75,
                                    swipe_min_touches: 1,
                                    swipe_direction: "horizontal",
                                    drag_block_vertical: false
                                },
                                arrows: {
                                    style: "zeus",
                                    enable: true,
                                    hide_onmobile: true,
                                    hide_under: 600,
                                    hide_onleave: true,
                                    hide_delay: 200,
                                    hide_delay_mobile: 1200,
                                    tmp: '<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
                                    left: {
                                        h_align: "left",
                                        v_align: "center",
                                        h_offset: 30,
                                        v_offset: 0
                                    },
                                    right: {
                                        h_align: "right",
                                        v_align: "center",
                                        h_offset: 30,
                                        v_offset: 0
                                    }
                                },
                                bullets: {
                                    enable: true,
                                    hide_onmobile: true,
                                    hide_under: 600,
                                    style: "metis",
                                    hide_onleave: true,
                                    hide_delay: 200,
                                    hide_delay_mobile: 1200,
                                    direction: "horizontal",
                                    h_align: "center",
                                    v_align: "bottom",
                                    h_offset: 0,
                                    v_offset: 30,
                                    space: 5,
                                    tmp: '<span class="tp-bullet-img-wrap">  <span class="tp-bullet-image"></span></span><span class="tp-bullet-title"></span>'
                                }
                            },
                            responsiveLevels: [1240, 1024, 778],
                            visibilityLevels: [1240, 1024, 778],
                            gridwidth: [1170, 1024, 778, 480],
                            gridheight: [600, 768, 960, 720],
                            lazyType: "none",
                            parallax: {
                                origo: "slidercenter",
                                speed: 1000,
                                levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 100, 55],
                                type: "scroll"
                            },
                            shadow: 0,
                            spinner: "off",
                            stopLoop: "on",
                            stopAfterLoops: 0,
                            stopAtSlide: -1,
                            shuffle: "off",
                            autoHeight: "off",
                            fullScreenAutoWidth: "off",
                            fullScreenAlignForce: "off",
                            fullScreenOffsetContainer: "",
                            fullScreenOffset: "0",
                            hideThumbsOnMobile: "off",
                            hideSliderAtLimit: 0,
                            hideCaptionAtLimit: 0,
                            hideAllCaptionAtLilmit: 0,
                            debugMode: false,
                            fallbacks: {
                                simplifyAll: "off",
                                nextSlideOnWindowFocus: "off",
                                disableFocusListener: false,
                            }
                        });
                    });
                </script>
                <!-- Slider Revolution Ends -->
            </div>
        </section>

        <!-- Section: Featured Projects  -->
        @if ($featuredCauses->count())

            <section>
                <div class="container">
                    <div class="section-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="font-weight-300 m-0">What we can do?</h5>
                                <h2 class="mt-0 text-uppercase font-28">Featured <span
                                        class="text-theme-colored font-weight-400">Projects</span> <span
                                        class="font-30 text-theme-colored">.</span></h2>
                                <div class="icon">
                                    <i class="fa fa-hospital-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="owl-carousel-3col" data-dots="true">
                                    @foreach ($featuredCauses as $featuredCausesKey => $featuredCausesDatum)
                                        <div class="item mb-10">
                                            <div class="image-box-thum">
                                                <a href="{{ route('campaignDetailPage', $featuredCausesDatum->slug) }}">
                                                    <img height="239" style=" border-radius:5px 5px 0 0;"
                                                         class="img-fullwidth" alt=""
                                                         src="{{ asset('uploads') . '/' . imageName($featuredCausesDatum->cover_image) }}">
                                                </a>
                                            </div>
                                            <div class="image-box-details bg-lighter p-15 pt-20 pb-sm-20">
                                                <h3 class="title mt-0 mb-5"><a
                                                        href="{{ route('campaignDetailPage', $featuredCausesDatum->slug) }}">{{ $featuredCausesDatum->title }}</a>
                                                </h3>
                                                <div class="project-meta mb-10 font-12">
                                                    <span class="mr-10"><i class="fa fa-tags"></i> <a rel="tag"
                                                                                                      href="{{ route('campaignDetailPage', $featuredCausesDatum->slug) }}">{{ $featuredCausesDatum->category->title }}</a></span>
                                                    <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                            class="fa fa-money mr-5 text-theme-colored"></i>
                                                        {{ $featuredCausesDatum->total_number_donation }}
                                                        Donations</span>
                                                    <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                            class="fa fa-eye mr-5 text-theme-colored"></i>
                                                        {{ $featuredCausesDatum->total_visits }} Views</span>
                                                </div>
                                                <p class="desc mb-10">
                                                    {{ substr($featuredCausesDatum->description, 0, 100) }}... <br> <a
                                                        href="{{ route('campaignDetailPage', $featuredCausesDatum->slug) }}"
                                                        class="text-info"> Read More...</a>
                                                </p>
                                                <div class="progress-item mt-0">
                                                    <div class="progress mb-10">
                                                        <div
                                                            data-percent="{{ calculatePercentageMaxTo100($featuredCausesDatum->summary_total_collection, $featuredCausesDatum->goal_amount) }}"
                                                            class="progress-bar"><span class="percent">0</span>
                                                        </div>
                                                    </div>
                                                    @if ($featuredCausesDatum->campaign_status == 'running')
                                                        <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mb-10"
                                                           href="{{ route('campaignDetailPage', $featuredCausesDatum->slug) }}">Donate
                                                            Now</a>
                                                    @elseif ($featuredCausesDatum->campaign_status == 'completed')
                                                        <a href="#"
                                                           class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10 disabled">Completed</a>
                                                    @else
                                                        <a href="#"
                                                           class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10 disabled">Expired</a>
                                                    @endif
                                                </div>
                                                <ul class="list-inline project-conditions text-center bg-deep m-0 p-10">
                                                    <li class="current-fund">
                                                        <strong>{{ calculatePercentageMaxTo100($featuredCausesDatum->summary_total_collection, $featuredCausesDatum->goal_amount) }}
                                                            %</strong>funded
                                                    </li>
                                                    <li class="target-fund">
                                                        <strong>{{ priceToNprFormat($featuredCausesDatum->goal_amount) }}</strong>target
                                                    </li>
                                                    <li class="remaining-days">
                                                        <strong>{{ getDaysDiffByToday($featuredCausesDatum->end_date) }}</strong>days
                                                        to go
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <section class="bg-lighter">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="font-weight-300 m-0">Happy Donate</h5>
                                    <h2 class="mt-0 text-uppercase font-28">Our <span
                                            class="font-30 text-theme-colored">Donors.</span></h2>
                                    <div class="icon">
                                        <i class="fa fa-hospital-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-carousel-6col" data-nav="true">
                            @foreach ($topDonors as $topDonorsKey => $topDonorsDatum)
                                <div class="item text-center">
                                    <img alt="" src="{{ $topDonorsDatum['profile_pic'] ?? '' }}">
                                    <div class="donor-details bg-white">
                                        <h4 class="m-0 pt-10 text-theme-colored">{{ $topDonorsDatum['name'] ?? '' }}</h4>
                                        <p class="font-12 pb-10">Donated :
                                            {{ priceToNprFormat($topDonorsDatum['amount'] ?? '') }}<br>Rank :
                                            {{ $topDonorsKey + 1 }}</p>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Divider: Funfact -->
        <section class="divider parallax layer-overlay overlay-white-8"
                 data-bg-img="{{ asset('frontend/images/bg/bg2.jpg') }}" data-parallax-ratio="0.7">
            <div class="container pt-90 pb-90">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                        <div class="funfact">
                            <i class="pe-7s-smile text-black-light mt-20 font-48 pull-left flip"></i>
                            <div class="ml-60">
                                <h2 class="animate-number text-theme-colored mt-0 font-48 line-bottom"
                                    data-value="{{ $total_donars }}" data-animation-duration="1500">0</h2>
                                <div class="clearfix"></div>
                                <h4 class="font-14">Happy Donators</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                        <div class="funfact">
                            <i class="pe-7s-rocket text-black-light mt-20 font-48 pull-left flip"></i>
                            <div class="ml-60">
                                <h2 class="animate-number text-theme-colored mt-0 font-48 line-bottom"
                                    data-value="{{ $total_campaign }}" data-animation-duration="1500">0</h2>
                                <div class="clearfix"></div>
                                <h4 class="font-14">Successful Campaigns</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                        <div class="funfact">
                            <i class="pe-7s-add-user text-black-light mt-20 font-48 pull-left flip"></i>
                            <div class="ml-60">
                                <h2 class="animate-number text-theme-colored mt-0 font-48 line-bottom"
                                    data-value="{{ $total_public_users }}" data-animation-duration="1200">0</h2>
                                <div class="clearfix"></div>
                                <h4 class="font-14">Total Users</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                        <div class="funfact">
                            <i class="pe-7s-cash text-black-light mt-20 font-48 pull-left flip"></i>
                            <div class="ml-60">
                                <h2 class="animate-number text-theme-colored mt-0 font-48 line-bottom"
                                    data-value="{{ $total_collection }}" data-animation-duration="1500">Rs.</h2>
                                <div class="clearfix"></div>
                                <h4 class="font-14">Total Collection</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section: Latest Projects  -->
        <section>
            <div class="container">
                <div class="section-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="font-weight-300 m-0">What we can do?</h5>
                            <h2 class="mt-0 text-uppercase font-28">Latest <span
                                    class="text-theme-colored font-weight-400">Projects</span> <span
                                    class="font-30 text-theme-colored">.</span></h2>
                            <div class="icon">
                                <i class="fa fa-hospital-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-content">
                    <div class="row">
                        @foreach ($recentCauses as $recentCausesKey => $recentCausesDatum)
                            <div class="col-xs-12 col-sm-6 col-md-4 mb-30">
                                <div class="image-box-thum">
                                    <a href="{{ route('campaignDetailPage', $featuredCausesDatum->slug) }}">
                                        <img height="239" class="img-fullwidth" style=" border-radius:5px 5px 0 0;"
                                             alt=""
                                             src="{{ asset('uploads') . '/' . imageName($recentCausesDatum->cover_image) }}">
                                    </a>
                                </div>
                                <div class="image-box-details bg-lighter p-15 pt-20 pb-sm-20">
                                    <h3 class="title mt-0 mb-5"><a
                                            href="{{ route('campaignDetailPage', $featuredCausesDatum->slug) }}">{{ substr($recentCausesDatum->title, 0, 100) }}</a>
                                    </h3>
                                    <div class="project-meta mb-10 font-12">
                                        <span class="mr-10"><i class="fa fa-tags"></i> <a rel="tag"
                                                                                          href="#">{{ $recentCausesDatum->category->title }}</a></span>
                                        <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                class="fa fa-money mr-5 text-theme-colored"></i>
                                            {{ $featuredCausesDatum->total_number_donation }}
                                            Donations</span>
                                        <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                class="fa fa-eye mr-5 text-theme-colored"></i>
                                            {{ $featuredCausesDatum->total_visits }} Views</span>
                                    </div>
                                    <p class="desc mb-10">
                                        {{ substr($recentCausesDatum->description, 0, 100) }}... <br> <a
                                            href="{{ route('campaignDetailPage', $featuredCausesDatum->slug) }}"
                                            class="text-info"> Read More...</a>
                                    </p>
                                    <div class="progress-item mt-0">
                                        <div class="progress mb-10">
                                            <div
                                                data-percent="{{ calculatePercentageMaxTo100($recentCausesDatum->summary_total_collection, $recentCausesDatum->goal_amount) }}"
                                                class="progress-bar"><span class="percent">0</span></div>
                                        </div>
                                        @if ($recentCausesDatum->campaign_status == 'running')
                                            <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mb-10"
                                               href="{{ route('campaignDetailPage', $recentCausesDatum->slug) }}">Donate
                                                Now</a>
                                        @elseif ($recentCausesDatum->campaign_status == 'completed')
                                            <a href="#"
                                               class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10 disabled">Completed</a>
                                        @else
                                            <a href="#"
                                               class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10 disabled">Expired</a>
                                        @endif
                                    </div>
                                    <ul class="list-inline project-conditions text-center bg-deep m-0 p-10">
                                        <li class="current-fund">
                                            <strong>{{ calculatePercentageMaxTo100($recentCausesDatum->summary_total_collection, $recentCausesDatum->goal_amount) }}
                                                %</strong>funded
                                        </li>
                                        <li class="target-fund">
                                            <strong>{{ priceToNprFormat($recentCausesDatum->goal_amount) }}</strong>target
                                        </li>
                                        <li class="remaining-days">
                                            <strong>{{ getDaysDiffByToday($recentCausesDatum->end_date) }}</strong>days
                                            to go
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach

                        {{-- <div class="col-md-12">
                            <div class="text-center">
                                <a class="btn btn-default btn-lg" href="#">Show More Projects</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
        <!-- Divider: testimonials -->
        <section class="bg-light">
            <div class="container pb-0">
                <h3 class="mt-0 line-bottom mb-30"><span class="font-weight-300">Clients </span> Testimonials</h3>
                <div class="row">
                    <div class="col-md-12 mb-30">
                        <div class="owl-carousel-2col boxed" data-dots="true">
                            @foreach ($testimonials as $testimonialsKey => $testimonialsDatum)
                                <div class="item">
                                    <div class="testimonial pt-10">
                                        <div class="thumb pull-left mb-0 mr-0 pr-20">
                                            <img width="75" class="img-circle" alt=""
                                                 src="{{ asset('uploads') . '/' . imageName($testimonialsDatum->profile_picture, '-cropped') }}">
                                        </div>
                                        <div class="ml-100 ">
                                            <h4 class="mt-0 font-weight-300">{{ $testimonialsDatum->message }}</h4>
                                            <p class="author mt-20">- <span
                                                    class="text-black-333">{{ $testimonialsDatum->name }},</span>
                                                <small><em>{{ $testimonialsDatum->designation }}</em></small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container pb-30">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="owl-carousel-6col clients-logo text-center">
                                @foreach ($partners as $partnersKey => $partnersDatum)
                                    <div class="item"><a href="#"><img class="img-responsive"
                                                                       src="{{ asset('uploads') . '/' . imageName($partnersDatum->logo, '-cropped') }}"
                                                                       alt=""></a>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- end main-content -->
@endsection
