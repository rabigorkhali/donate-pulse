@extends('backend.system.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('backend.system.partials.errors')
        <div class="card mb-4">
            <h5 class="card-header">{{ $title }}</h5>

            <form class="card-body" action="{{ route('testimonials.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="name">{{ __('Name') }}</label> *
                        <input required value="{{ old('name') }}" type="text" name="name" id="name"
                               class="form-control @if ($errors->first('name')) is-invalid @endif"
                               placeholder="Name"/>
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="designation">{{ __('Designation') }}</label>
                        <input  value="{{ old('designation') }}" type="text" name="designation" id="designation"
                                class="form-control @if ($errors->first('designation')) is-invalid @endif"
                                placeholder="Designation"/>
                        <div class="invalid-feedback">{{ $errors->first('designation') }}</div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="message">{{ __('Message') }}</label> *
                        <textarea required name="message" id="message" rows="4"
                                  class="form-control @if ($errors->first('message')) is-invalid @endif"
                                  placeholder="Message">{{ old('message') }}</textarea>
                        <div class="invalid-feedback">{{ $errors->first('message') }}</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="position">{{ __('Position') }}</label> *
                        <input required value="{{ old('position') }}" type="text" name="position" id="position"
                               class="form-control @if ($errors->first('position')) is-invalid @endif"
                               placeholder="Position"/>
                        <div class="invalid-feedback">{{ $errors->first('position') }}</div>
                    </div>



                    <div class="col-md-6">
                        <label class="form-label" for="image">{{ __('Image') }}</label> *
                        <input type="file" required name="image" id="image"
                               class="form-control @if ($errors->first('image')) is-invalid @endif"/>
                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label w-100" for="status">{{ __('Status') }}</label>
                        <div class="form-check-inline">
                            <input type="radio" id="status1" name="status" value="1" checked
                                   class="form-check-input @if ($errors->first('status')) is-invalid @endif"
                                   @if(old('status') == '1') checked @endif>
                            <label for="status1" class="form-check-label">{{ __('Active') }}</label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" id="status2" name="status" value="0"
                                   class="form-check-input @if ($errors->first('status')) is-invalid @endif"
                                   @if(old('status') == '0') checked @endif>
                            <label for="status2" class="form-check-label">{{ __('Inactive') }}</label>
                        </div>
                        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('Create') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
