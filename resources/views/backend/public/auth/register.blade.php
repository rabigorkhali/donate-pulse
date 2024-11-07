@extends('backend.public.layouts.master')
@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Login -->
                @include('backend.system.partials.errors')
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        @if(getConfigTableData()?->logo)
                            <div class="app-brand justify-content-center mb-4 mt-2">
                                <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{getConfigTableData()?->logo}}" width="50">
                                </span>
                                </a>
                            </div>
                        @endif
                        <!-- /Logo -->
                        <p class="mb-4">{{ __('Please fill the form for creating new account.') }}</p>

                        <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input required type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') }}"
                                       placeholder="Enter your full name" autofocus/>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input required type="text" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') }}"
                                       placeholder="Enter your email" autofocus/>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{--                            <div class="mb-3">--}}
                            {{--                                <label for="password" class="form-label">{{ __('Password') }}</label>--}}
                            {{--                                <input type="password" class="form-control @error('password') is-invalid @enderror"--}}
                            {{--                                       id="password" name="password" value="{{ old('password') }}"--}}
                            {{--                                       placeholder="Enter your password" autofocus/>--}}
                            {{--                                @error('password')--}}
                            {{--                                <span class="invalid-feedback" role="alert">--}}
                            {{--                                        <strong>{{ $message }}</strong>--}}
                            {{--                                    </span>--}}
                            {{--                                @enderror--}}
                            {{--                            </div>--}}
                            {{--                            <div class="mb-3">--}}
                            {{--                                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>--}}
                            {{--                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"--}}
                            {{--                                       id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"--}}
                            {{--                                       placeholder="Enter your email" autofocus/>--}}
                            {{--                                @error('password_confirmation')--}}
                            {{--                                <span class="invalid-feedback" role="alert">--}}
                            {{--                                        <strong>{{ $message }}</strong>--}}
                            {{--                                    </span>--}}
                            {{--                                @enderror--}}
                            {{--                            </div>--}}
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100"
                                        type="submit">{{ __('Create Account') }}</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>{{ __('Already have account?') }}</span>
                            <a href="{{ route('login') }}">
                                <span>{{ __('Login here') }}</span>
                            </a>
                        </p>


                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
@endsection
