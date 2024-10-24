@extends('backend.system.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('backend.system.partials.errors')
        <div class="card mb-4">
            <h5 class="card-header">{{ $title }}</h5>

            <form class="card-body" action="{{ route('campaigns.update', $thisData->id) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $thisData->id }}">
                <div class="row g-3">
                    <!-- Title Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="title">{{ __('Title') }}</label> *
                        <input required value="{{ $thisData->title ?? old('title') }}" type="text" name="title"
                               id="title"
                               class="form-control @if ($errors->first('title')) is-invalid @endif"
                               placeholder="Title"/>
                        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                    </div>

                    <!-- Slug Field -->
                    <div class="col-md-6 d-none">
                        <label class="form-label" for="slug">{{ __('Slug') }}</label> *
                        <input required value="{{ $thisData->slug ?? old('slug') }}" type="text" name="slug" id="slug"
                               class="form-control @if ($errors->first('slug')) is-invalid @endif"
                               placeholder="Slug"/>
                        <div class="invalid-feedback">{{ $errors->first('slug') }}</div>
                    </div>

                    <!-- User ID Field (Dropdown) -->
                    @if (authUser()->role->name !== 'public-user')

                        <div class="col-md-6">
                            <label class="form-label" for="user_id">{{ __('Campaign Owner') }}</label> *
                            <select required name="user_id" id="user_id"
                                    class="form-control @if ($errors->first('user_id')) is-invalid @endif">
                                <option value="">{{ __('Select User') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                            @if(($thisData->user_id ?? old('user_id')) == $user->id) selected @endif>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('user_id') }}</div>
                        </div>
                    @endif

                    <!-- Campaign Category ID Field (Dropdown) -->
                    <div class="col-md-6">
                        <label class="form-label" for="campaign_category_id">{{ __('Campaign Category') }}</label> *
                        <select required name="campaign_category_id" id="campaign_category_id"
                                class="form-control @if ($errors->first('campaign_category_id')) is-invalid @endif">
                            <option value="">{{ __('Select Campaign Category') }}</option>
                            @foreach($campaignCategories as $category)
                                <option value="{{ $category->id }}"
                                        @if(($thisData->campaign_category_id ?? old('campaign_category_id')) == $category->id) selected @endif>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ $errors->first('campaign_category_id') }}</div>
                    </div>

                    <!-- Start Date Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="start_date">{{ __('Start Date') }}</label> *
                        <input required type="date" name="start_date" id="start_date"
                               value="{{ $thisData->start_date ?? old('start_date') }}"
                               class="form-control @if ($errors->first('start_date')) is-invalid @endif"/>
                        <div class="invalid-feedback">{{ $errors->first('start_date') }}</div>
                    </div>

                    <!-- End Date Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="end_date">{{ __('End Date') }}</label> *
                        <input required type="date" name="end_date" id="end_date"
                               value="{{ $thisData->end_date ?? old('end_date') }}"
                               class="form-control @if ($errors->first('end_date')) is-invalid @endif"/>
                        <div class="invalid-feedback">{{ $errors->first('end_date') }}</div>
                    </div>

                    <!-- Goal Amount Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="goal_amount">{{ __('Goal Amount') }}</label> *
                        <input required type="number" name="goal_amount" id="goal_amount"
                               value="{{ $thisData->goal_amount ?? old('goal_amount') }}"
                               class="form-control @if ($errors->first('goal_amount')) is-invalid @endif" min="0"/>
                        <div class="invalid-feedback">{{ $errors->first('goal_amount') }}</div>
                    </div>

                    <!-- Country Field (Dropdown) -->
                    <div class="col-md-6">
                        <label class="form-label" for="country">{{ __('Country') }}</label> *
                        <select required name="country" id="country"
                                class="form-control @if ($errors->first('country')) is-invalid @endif">
                            <option value="">{{ __('Select Country') }}</option>
                            <option value="nepal"
                                    @if(($thisData->country ?? old('country')) == 'nepal') selected @endif>{{ __('Nepal') }}</option>
                            <option value="india"
                                    @if(($thisData->country ?? old('country')) == 'india') selected @endif>{{ __('India') }}</option>
                            <option value="other"
                                    @if(($thisData->country ?? old('country')) == 'other') selected @endif>{{ __('Other') }}</option>
                        </select>
                        <div class="invalid-feedback">{{ $errors->first('country') }}</div>
                    </div>

                    <!-- Address Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="address">{{ __('Address') }}</label> *
                        <input required value="{{ $thisData->address ?? old('address') }}" type="text" name="address"
                               id="address"
                               class="form-control @if ($errors->first('address')) is-invalid @endif"
                               placeholder="Address"/>
                        <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                    </div>

                    <!-- Campaign Status Field -->
                    @if (authUser()->role->name !== 'public-user')
                        <div class="col-md-6">
                            <label class="form-label" for="campaign_status">{{ __('Campaign Status') }}</label> *
                            <select required name="campaign_status" id="campaign_status"
                                    class="form-control @if ($errors->first('campaign_status')) is-invalid @endif">
                                <option value="">Select</option>
                                @foreach(getCampaignStatus() as $getCampaignStatusKey => $getCampaignStatusDatum)
                                    <option value="{{ $getCampaignStatusKey }}"
                                            @if(($thisData->campaign_status ?? old('campaign_status')) == $getCampaignStatusKey) selected @endif>
                                        {{ $getCampaignStatusDatum }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('campaign_status') }}</div>
                        </div>
                    @endif

                    <!-- Is Featured Field -->
                    <div class="col-md-6">
                        <label class="form-label w-100" for="status">{{ __('Is Featured?') }}</label>
                        <div class="form-check-inline">
                            <input type="radio" id="feature1" name="is_featured" value="1"
                                   class="form-check-input @if ($errors->first('is_featured')) is-invalid @endif"
                                   @if(($thisData->is_featured ?? old('is_featured')) == '1') checked @endif>
                            <label for="feature1" class="form-check-label">{{ __('Yes') }}</label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" id="feature2" name="is_featured" value="0"
                                   class="form-check-input @if ($errors->first('is_featured')) is-invalid @endif"
                                   @if(($thisData->is_featured ?? old('is_featured')) == '0') checked @endif>
                            <label for="feature2" class="form-check-label">{{ __('No') }}</label>
                        </div>
                        <div class="invalid-feedback">{{ $errors->first('is_featured') }}</div>
                    </div>

                    <!-- Description Field -->
                    <div class="col-md-12">
                        <label class="form-label" for="description">{{ __('Description') }}</label> *
                        <textarea required name="description" id="description"
                                  class="form-control text-editor @if ($errors->first('description')) is-invalid @endif"
                                  placeholder="Description">{{ $thisData->description ?? old('description') }}</textarea>
                        <span>To prevent fraud and money laundering, please do not mention personal bank account/payment gateway details in description.</span>
                        <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                    </div>

                    <!-- Status Field -->
                    <div class="col-md-6">
                        <label class="form-label w-100" for="status">{{ __('Status') }}</label>
                        <div class="form-check-inline">
                            <input type="radio" id="status1" name="status" value="1"
                                   class="form-check-input @if ($errors->first('status')) is-invalid @endif"
                                   @if(($thisData->status ?? old('status')) == '1') checked @endif>
                            <label for="status1" class="form-check-label">{{ __('Active') }}</label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" id="status2" name="status" value="0"
                                   class="form-check-input @if ($errors->first('status')) is-invalid @endif"
                                   @if(($thisData->status ?? old('status')) == '0') checked @endif>
                            <label for="status2" class="form-check-label">{{ __('Inactive') }}</label>
                        </div>
                        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="image">{{ __('Cover Image') }}</label>
                        <input type="file" name="cover_image" id="cover_image"
                               class="form-control @if ($errors->first('cover_image')) is-invalid @endif"/>
                        <div class="invalid-feedback">{{ $errors->first('cover_image') }}</div>
                        @if ($thisData->cover_image)
                            <div class="col-md-6 mt-2">
                                <a target="_blank" href="{{ asset($thisData->cover_image) }}">
                                    <img src="{{ asset($thisData->cover_image) }}" width="100" alt="Image"
                                         class="img-fluid">
                                </a>
                            </div>
                        @endif
                    </div>

                </div>
                <div class="pt-3">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
