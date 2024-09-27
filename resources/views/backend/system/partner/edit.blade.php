@extends('backend.system.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('backend.system.partials.errors')
        <div class="card mb-4">
            <h5 class="card-header">{{ $title }}</h5>

            <form class="card-body" action="{{ route('partners.update', $thisData->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $thisData->id }}">
                <div class="row g-3">
                    <!-- Name Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="name">{{ __('Partner Name') }}</label> *
                        <input required value="{{ $thisData->name ?? '' }}" type="text" name="name" id="name"
                               class="form-control @if ($errors->first('name')) is-invalid @endif"
                               placeholder="Partner Name"/>
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    </div>

                    <!-- Website URL Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="website">{{ __('Website URL') }}</label>
                        <input value="{{ $thisData->website ?? '' }}" type="url" name="website" id="website"
                               class="form-control @if ($errors->first('website')) is-invalid @endif"
                               placeholder="Website URL"/>
                        <div class="invalid-feedback">{{ $errors->first('website') }}</div>
                    </div>

                    <!-- Description Field -->
                    <div class="col-md-12">
                        <label class="form-label" for="description">{{ __('Description') }}</label> *
                        <textarea name="description" id="description" rows="4"
                                  class="form-control @if ($errors->first('description')) is-invalid @endif"
                                  placeholder="Description">{{ $thisData->description ?? '' }}</textarea>
                        <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                    </div>

                    <!-- Image Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="image">{{ __('Partner Logo') }}</label>
                        <input type="file" name="image" id="image"
                               class="form-control @if ($errors->first('image')) is-invalid @endif"/>
                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                        @if($thisData->image)
                            <div class="col-md-6 mt-2">
                                <a target="_blank" href="{{ asset($thisData->image) }}">
                                    <img src="{{ asset($thisData->image) }}" width="100" alt="Partner Logo" class="img-fluid">
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Status Field -->
                    <div class="col-md-6">
                        <label class="form-label w-100" for="status">{{ __('Status') }}</label>
                        <div class="form-check-inline">
                            <input id="status1" type="radio" name="status" value="1"
                                   class="form-check-input @if ($errors->first('status')) is-invalid @endif"
                                   @if($thisData->status == '1') checked @endif>
                            <label for="status1" class="form-check-label">{{ __('Active') }}</label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" id="status2" name="status" value="0"
                                   class="form-check-input @if ($errors->first('status')) is-invalid @endif"
                                   @if($thisData->status == '0') checked @endif>
                            <label for="status2" class="form-check-label">{{ __('Inactive') }}</label>
                        </div>
                        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
