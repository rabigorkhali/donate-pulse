@extends('frontend.master')
@section('title', 'Home')
@section('content')
    <div class="main-content">
        <!-- Section: inner-header -->

        <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-stellar-background-ratio="0.5"
                 data-bg-img="{{ asset('uploads') . '/' . imageName($pageDetails->image, '-cropped') }}"
                 style="background-image: url('{{ asset('uploads') . '/' . imageName($pageDetails->image, '-cropped') }}'); background-position: 50% 61px;">
            <div class="container pt-100 pb-50">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title text-white">{{$pageDetails->title}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Section: About -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <img class="pull-left mr-15 thumbnail" src="http://placehold.it/430x240" alt="">
                        <p> {!! $pageDetails->body !!} </p>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
