@extends('backend.system.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('backend.system.partials.errors')
        <div class="card mb-4">
            <h5 class="card-header">{{ __('Create Donation') }}</h5>
            <form class="card-body" action="{{ route('donations.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <!-- Giver User ID -->
                    <div class="col-md-6">
                        <label class="form-label" for="giver_user_id">{{ __('Giver User') }}</label> *
                        <select required class="form-control @error('giver_user_id') is-invalid @enderror"
                                name="giver_user_id">
                            <option value="">{{ __('Select User') }}</option>
                            @foreach($users as $user)
                                <option @if(old('giver_user_id') == $user->id) selected @endif value="{{ $user->id }}">
                                    {{ ucfirst($user->name) }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">@error('giver_user_id') {{ $message }} @enderror</div>
                    </div>

                    <!-- Receiver User ID -->
                    <div class="col-md-6">
                        <label class="form-label" for="receiver_user_id">{{ __('Receiver User') }}</label> *
                        <select required class="form-control @error('receiver_user_id') is-invalid @enderror"
                                name="receiver_user_id">
                            <option value="">{{ __('Select Receiver') }}</option>
                            @foreach($users as $user)
                                <option @if(old('receiver_user_id') == $user->id) selected
                                        @endif value="{{ $user->id }}">
                                    {{ ucfirst($user->name) }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">@error('receiver_user_id') {{ $message }} @enderror</div>
                    </div>

                    <!-- Campaign ID -->
                    <div class="col-md-6">
                        <label class="form-label" for="campaign_id">{{ __('Campaign') }}</label> *
                        <select required class="form-control select2 @error('campaign_id') is-invalid @enderror"
                                name="campaign_id">
                            <option value="">{{ __('Select Campaign') }}</option>
                            @foreach($campaigns as $campaign)
                                <option @if(old('campaign_id') == $campaign->id) selected
                                        @endif value="{{ $campaign->id }}">
                                    {{ ucfirst($campaign->title) }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">@error('campaign_id') {{ $message }} @enderror</div>
                    </div>

                    <!-- Transaction ID -->
                    <div class="col-md-6">
                        <label class="form-label" for="transaction_id">{{ __('Transaction ID') }}</label>
                        <input type="text" name="transaction_id" id="transaction_id" value="{{ old('transaction_id') }}"
                               class="form-control @error('transaction_id') is-invalid @enderror"
                               placeholder="Transaction ID"/>
                        <div class="invalid-feedback">@error('transaction_id') {{ $message }} @enderror</div>
                    </div>

                    <!-- Full Name -->
                    <div class="col-md-6">
                        <label class="form-label" for="fullname">{{ __('Full Name') }}</label> *
                        <input required type="text" name="fullname" id="fullname" value="{{ old('fullname') }}"
                               class="form-control @error('fullname') is-invalid @enderror" placeholder="Full Name"/>
                        <div class="invalid-feedback">@error('fullname') {{ $message }} @enderror</div>
                    </div>

                    <!-- Country -->
                    <div class="col-md-6">
                        <label class="form-label" for="country">{{ __('Country') }}</label> *
                        <select required name="country" id="country"
                                class="form-control @if ($errors->first('country')) is-invalid @endif">
                            <option value="">{{ __('Select Country') }}</option>
                            <option value="nepal"
                                    @if(old('country') == 'nepal') selected @endif>{{ __('Nepal') }}</option>
                            <option value="india"
                                    @if(old('country') == 'india') selected @endif>{{ __('India') }}</option>
                            <option value="other"
                                    @if(old('country') == 'other') selected @endif>{{ __('Other') }}</option>
                        </select>
                        <div class="invalid-feedback">{{ $errors->first('country') }}</div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label" for="email">{{ __('Email') }}</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror" placeholder="Email"/>
                        <div class="invalid-feedback">@error('email') {{ $message }} @enderror</div>
                    </div>

                    <!-- Payment Status -->
                    <div class="col-md-6">
                        <label class="form-label" for="payment_status">{{ __('Payment Status') }}</label> *
                        <select required class="form-control @error('payment_status') is-invalid @enderror"
                                name="payment_status">
                            <option value="">{{ __('Select Payment Status') }}</option>
                            <option value="completed"
                                    @if(old('payment_status') == 'completed') selected @endif>{{ __('Completed') }}</option>
                            <option value="pending"
                                    @if(old('payment_status') == 'pending') selected @endif>{{ __('Pending') }}</option>
                        </select>
                        <div class="invalid-feedback">@error('payment_status') {{ $message }} @enderror</div>
                    </div>

                    <!-- Payment Gateway -->
                    <div class="col-md-6">
                        <label class="form-label" for="payment_gateway">{{ __('Payment Gateway') }}</label> *
                        <select name="payment_gateway" class="form-select @error('payment_gateway') is-invalid @enderror">
                            <option value="">{{ __('Select Payment Gateway') }}</option>
                            <option value="bank"
                                    @if (request('payment_gateway') == 'offline') selected @endif>
                                Offline
                            </option>
                            <option value="bank"
                                    @if (request('payment_gateway') == 'bank') selected @endif>
                                Bank
                            </option>
                            <option value="esewa"
                                    @if (request('payment_gateway') == 'esewa') selected @endif>
                                Esewa
                            </option>
                            <option value="khalti"
                                    @if (request('payment_gateway') == 'khalti') selected @endif>
                                Khalti
                            </option>
                        </select>
                        <div class="invalid-feedback">@error('payment_gateway') {{ $message }} @enderror</div>
                    </div>

                    <!-- Amount -->
                    <div class="col-md-6">
                        <label class="form-label" for="amount">{{ __('Amount') }}</label> *
                        <input required type="number" name="amount" id="amount" value="{{ old('amount') }}"
                               class="form-control @error('amount') is-invalid @enderror" placeholder="Amount"/>
                        <div class="invalid-feedback">@error('amount') {{ $message }} @enderror</div>
                    </div>

                    <!-- Service Charge Percentage -->
                    <div class="col-md-6">
                        <label class="form-label"
                               for="service_charge_percentage">{{ __('Service Charge Percentage') }}</label> *
                        <input required type="number" step="0.01" name="service_charge_percentage"
                               id="service_charge_percentage" value="{{ old('service_charge_percentage')??7 }}"
                               class="form-control @error('service_charge_percentage') is-invalid @enderror"
                               placeholder="Service Charge %"/>
                        <div class="invalid-feedback">@error('service_charge_percentage') {{ $message }} @enderror</div>
                    </div>

                    <!-- Mobile Number -->
                    <div class="col-md-6">
                        <label class="form-label" for="mobile_number">{{ __('Mobile Number') }}</label>
                        <input type="text" name="mobile_number" id="mobile_number" value="{{ old('mobile_number') }}"
                               class="form-control @error('mobile_number') is-invalid @enderror"
                               placeholder="Mobile Number"/>
                        <div class="invalid-feedback">@error('mobile_number') {{ $message }} @enderror</div>
                    </div>

                    <!-- Payment Receipt -->
                    <div class="col-md-6">
                        <label class="form-label" for="payment_receipt">{{ __('Payment Receipt') }}</label>
                        <input type="file" name="payment_receipt" id="payment_receipt"
                               class="form-control @error('payment_receipt') is-invalid @enderror"/>
                        <div class="invalid-feedback">@error('payment_receipt') {{ $message }} @enderror</div>
                    </div>

                    <!-- Address -->
                    <div class="col-md-6">
                        <label class="form-label" for="address">{{ __('Address') }}</label>
                        <input type="text" name="address" id="address" value="{{ old('address') }}"
                               class="form-control @error('address') is-invalid @enderror"
                               placeholder="Mobile Number"/>
                        <div class="invalid-feedback">@error('address') {{ $message }} @enderror</div>
                    </div>

                    <!-- Description -->
                    <div class="col-md-12">
                        <label class="form-label" for="description">{{ __('Description') }}</label>
                        <textarea name="description" id="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Description">{{ old('description') }}</textarea>
                        <div class="invalid-feedback">@error('description') {{ $message }} @enderror</div>
                    </div>

                    <!-- Do Not Display Image -->
                    <div class="col-md-6">
                        <label class="form-label" for="donor_display_image">{{ __('Donor Display Image') }}</label>
                        <input type="file" name="donor_display_image" id="donor_display_image"
                               class="form-control @error('donor_display_image') is-invalid @enderror"/>
                        <div class="invalid-feedback">@error('donor_display_image') {{ $message }} @enderror</div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">{{ __('Submit Donation') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
