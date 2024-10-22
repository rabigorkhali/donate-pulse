@extends('backend.system.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('backend.system.partials.errors')
        <div class="card mb-4">
            <h5 class="card-header">{{ __('Create Withrawal') }}</h5>
            <form class="card-body" action="{{ route('withdrawals.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
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
                    <div class="col-md-6">
                        <label class="form-label" for="payment_gateway_id">{{ __('Receiver User') }}</label> *
                        <select required class="form-control @error('payment_gateway_id') is-invalid @enderror"
                                name="payment_gateway_id">
                            <option value="">{{ __('Select Payment Gateway') }}</option>
                            @foreach($paymentGateways as $paymentGateway)
                                <option @if(old('payment_gateway_id') == $paymentGateway->id) selected
                                        @endif value="{{ $paymentGateway->id }}">
                                    {{ ucfirst($paymentGateway->payment_gateway) }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">@error('payment_gateway_id') {{ $message }} @enderror</div>
                    </div>


                    <!-- Submit Button -->
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">{{ __('Submit Donation') }}</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
