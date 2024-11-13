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

                    @if(authUser()->role->name!=='public-user')
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
                    @endif

                    <div class="col-md-6 ">
                        <label class="form-label" for="image">{{ 'Receipt (Must be image) *' }}</label>
                        <input value="{{ $thisData?->receipt ?? old('receipt') }}" type="file" name="receipt"
                               id="receipt" class="form-control @if ($errors->first('receipt')) is-invalid @endif"/>
                        <div class="invalid-feedback">{{ $errors->first('receipt') }}</div>
                    </div>
                    <div class="col-md-6 mt-2">
                    </div>
                    @if($thisData?->receipt)
                        <div class="col-md-6 mt-2">
                            <a target="_blank" href="{{ asset($thisData?->receipt) }}">
                                <img src="{{ asset($thisData?->receipt) }}" width="100" alt="Image"
                                     class="img-fluid"></a>
                        </div>
                    @endif

                </div>

                <div class="pt-4">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('Update') }}</button>
                </div>
            </form>

        </div>
    </div>
@endsection
