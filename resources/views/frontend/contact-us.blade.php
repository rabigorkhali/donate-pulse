@extends('frontend.master')
@section('title', 'Contact Us')
@section('content')
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-stellar-background-ratio="0.5"
                 data-bg-img=""
                 style="background-image: url(&quot;images/bg/bg1.jpg&quot;); background-position: 50% 61px;">
            <div class="container pt-100 pb-50">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">

                            <h3 class="title text-white">Contact Us</h3>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="donationForm" class="divider parallax"
                 data-bg-img="{{ asset('/public/uploads') . '/'  }}" data-parallax-ratio="0.7"
                 style="background-image: url('{{ asset('/public/uploads') . '/'  }}'); background-position: 50% 76px;">
            <div class="container pt-0 pb-0">
                <div class="row">
                    <div class="col-md-8">
                        <div class="bg-light-transparent p-40">
                            {{-- BANK --}}
                            <form id="" class=""
                                  action="{{ route('frontendContactusCreate') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="honeypot" value="">
                                <div class="row">

                                    <div class="col-sm-12 @if ($errors->first('name')) has-error @endif">
                                        <div class="form-group mb-20">
                                            <label><strong>Name</strong><span class="text-danger">*</span></label>
                                            <input required type="text" maxlength="100" name="name"
                                                   min="7"
                                                   value="{{ old('name') ?? Auth::user()?->full_name }}"
                                                   placeholder="Rama Namaya" class="form-control">
                                            @if ($errors->first('name'))
                                                <span
                                                    class="text-danger display-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12  @if ($errors->first('phone')) has-error @endif">
                                        <div class="form-group mb-20">
                                            <label><strong>Phone Number</strong><span class="text-danger">*</span></label>
                                            <input required id="mobileNumber" type="text" maxlength="15"
                                                   minlength="10" name="phone"
                                                   value="{{ old('phone') ?? Auth::user()?->mobile_number }}"
                                                   placeholder="9841000000" class="form-control">
                                            @if ($errors->first('phone'))
                                                <span
                                                    class="text-danger display-block">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 @if ($errors->first('email')) has-error @endif">
                                        <div class="form-group mb-20">
                                            <label><strong>Email</strong><span class="text-danger">*</span></label>
                                            <input required type="email"
                                                   value="{{ old('email') ?? Auth::user()?->email }}"
                                                   name="email" placeholder="example@example.com" class="form-control">
                                            @if ($errors->first('email'))
                                                <span
                                                    class="text-danger display-block">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-sm-12 @if ($errors->first('message')) has-error @endif">
                                        <div class="form-group mb-20">
                                            <label><strong>Message</strong><span class="text-danger">*</span></label>
                                            <textarea required minlength="15" maxlength="100" rows="6" id="message" name="message"
                                                      class="form-control" value="message" placeholder="Message">{{ old('message') }}</textarea>
                                            @if ($errors->first('message'))
                                                <span
                                                    class="text-danger display-block">{{ $errors->first('message') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" id="" type="button"
                                                    class="btn btn-flat btn-dark btn-theme-colored mt-10 pl-30 pr-30"
                                                    data-loading-text="Please wait...">Submit</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            {{-- END BANK --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>

@endsection
