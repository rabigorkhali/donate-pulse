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
                            <form class="form-inline" action="{{ route('campaignList') }}" method="get">
                                <div class="form-group">
                                    <input type="text" value="{{ request('title') }}" name="title"
                                           style="border-radius: 4px; height:37px; width:300px;"
                                           class="form-control mt-10"
                                           id="" placeholder="Search campaign.....">
                                    <select name="category" class="form-control mt-10"
                                            style="border-radius: 4px; height:37px; width:300px;">
                                        <option value="">All</option>
                                        @foreach ($campaignCategories as $campaignCategoriesDatum)
                                            <option @if (request('category') == $campaignCategoriesDatum->slug) selected
                                                    @endif
                                                    value="{{ $campaignCategoriesDatum->slug }}">
                                                {{ $campaignCategoriesDatum->title }}</option>
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
                            @if ($causesList->count())
                                <h2 class="mt-0 text-uppercase font-28">Campaigns </h2>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="section-content">
                    <div class="row">
                        @foreach ($causesList as $causesListKey => $causesListDatum)
                            <div class="col-xs-12 col-sm-6 col-md-4 mb-30">
                                <div class="image-box-thum">
                                    <a href="{{ route('campaignDetailPage', $causesListDatum->slug) }}">
                                        <img height="239" class="img-fullwidth " style=" border-radius:5px 5px 0 0;"
                                             alt=""
                                             src="{{ asset('uploads') . '/' . imageName($causesListDatum->cover_image) }}">
                                    </a>
                                </div>
                                <div class="image-box-details bg-lighter p-15 pt-20 pb-sm-20">
                                    <h3 class="title mt-0 mb-5"><a
                                                href="{{ route('campaignDetailPage', $causesListDatum->slug) }}">{{ substr($causesListDatum->title, 0, 100) }}</a>
                                    </h3>
                                    <div class="project-meta mb-10 font-12">
                                        <span class="mr-10"><i class="fa fa-tags"></i> <a rel="tag"
                                                                                          href="#">{{ $causesListDatum->category->title }}</a></span>
                                        <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                    class="fa fa-money mr-5 text-theme-colored"></i>
                                            {{ $causesListDatum->total_number_donation }}
                                            Donations</span>
                                        <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                    class="fa fa-eye mr-5 text-theme-colored"></i>
                                            {{ $causesListDatum->total_visits }} Views</span>
                                    </div>
                                    <p class="desc mb-10">
                                        {{ substr($causesListDatum->description, 0, 100) }}... <br> <a
                                                href="{{ route('campaignDetailPage', $causesListDatum->slug) }}"
                                                class="text-info"> Read More...</a>
                                    </p>
                                    <div class="progress-item mt-0">
                                        <div class="progress mb-10">
                                            <div data-percent="{{ calculatePercentageMaxTo100($causesListDatum->summary_total_collection, $causesListDatum->goal_amount) }}"
                                                 class="progress-bar"><span class="percent">0</span></div>
                                        </div>
                                        @if ($causesListDatum->campaign_status == 'running')
                                            <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mb-10"
                                               href="{{ route('campaignDetailPage', $causesListDatum->slug) }}">Donate
                                                Now</a>
                                        @elseif ($causesListDatum->campaign_status == 'completed')
                                            <a href="#"
                                               class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10 disabled">Completed</a>
                                        @else
                                            <a href="#"
                                               class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10 disabled">Expired</a>
                                        @endif

                                    </div>
                                    <ul class="list-inline project-conditions text-center bg-deep m-0 p-10">
                                        <li class="current-fund">
                                            <strong>{{ calculatePercentageMaxTo100($causesListDatum->summary_total_collection, $causesListDatum->goal_amount) }}
                                                %</strong>funded
                                        </li>
                                        <li class="target-fund">
                                            <strong>{{ priceToNprFormat($causesListDatum->goal_amount) }}</strong>target
                                        </li>
                                        <li class="remaining-days">
                                            <strong>{{ getDaysDiffByToday($causesListDatum->end_date) }}</strong>days
                                            to go
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                        @if (!$causesList->count())
                            <div class="col-md-5">
                            </div>
                            <div class="col-md-6">
                                <h2 class="font-weight-300 m-0">Campaigns not found.</h2>

                            </div>
                        @endif

                        {{-- <div class="col-md-12">
                            <div class="text-center">
                                <a class="btn btn-default btn-lg" href="#">Show More Projects</a>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="d-flex justify-content-center float-right">

                    {{ $causesList->appends(request()->except('page'))->links('pagination::bootstrap-4') }}

                </div>
            </div>
        </section>
    </div>
    <!-- end main-content -->
@endsection
