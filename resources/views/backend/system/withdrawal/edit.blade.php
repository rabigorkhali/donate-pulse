@extends('backend.system.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('backend.system.partials.errors')
        <div class="card mb-4">
            <h5 class="card-header">{{ $title }}</h5>

            <form class="card-body" action="{{ route('withdrawals.update', $thisData->id) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $thisData->id }}">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label" for="campaign_id">{{ __('Campaign') }}</label> *
                        <select readonly required class="form-control @error('campaign_id') is-invalid @enderror"
                                name="campaign_id">
                            <option value="{{ $thisData->campaign->id }}">
                                {{ ucfirst($thisData->campaign->title) }}
                            </option>
                        </select>
                        <div class="invalid-feedback">@error('campaign_id') {{ $message }} @enderror</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="payment_gateway_id">{{ __('Payment Gateway') }}</label> *
                        <select required class="form-control @error('payment_gateway_id') is-invalid @enderror"
                                name="payment_gateway_id">
                            <option value="">{{ __('Select Payment Gateway') }}</option>
                            @foreach($paymentGateways as $paymentGateway)
                                <option
                                    @if($thisData->payment_gateway_id == $paymentGateway->id) selected
                                    @endif value="{{ $paymentGateway->id }}">
                                    {{ ucfirst($paymentGateway->payment_gateway) }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">@error('payment_gateway_id') {{ $message }} @enderror</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="payment_gateway_id">{{ __('Withdrawal Status') }}</label> *
                        <select required class="form-control @error('withdrawal_status') is-invalid @enderror"
                                name="withdrawal_status">
                            <option value="">{{ __('Select Withdrawal Status') }}</option>
                            @foreach(withdrawalStatus() as $thisKey => $thisDatum)
                                <option
                                    @if($thisData->withdrawal_status == $thisKey) selected
                                    @endif value="{{ $thisKey }}">
                                    {{ ucfirst($thisDatum) }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">@error('payment_gateway_id') {{ $message }} @enderror</div>
                    </div>

                </div>

                <div class="pt-4">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('Update') }}</button>
                </div>
            </form>

        </div>
    </div>
@endsection
