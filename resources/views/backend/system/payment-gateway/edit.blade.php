@extends('backend.system.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('backend.system.partials.errors')
        <div class="card mb-4">
            <h5 class="card-header">{{ __('Create Payment Gateway') }}</h5>

            <form class="card-body" action="{{ route('payment-gateways.update', $thisData->id) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <!-- User ID -->
                    <div class="col-md-6">
                        <label class="form-label" for="user_id">{{ __('User') }}</label> *
                        <select required class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                            <option value="">{{ __('Select User') }}</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                        @if($thisData->user_id ?? old('user_id') == $user->id) selected @endif>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">@error('user_id') {{ $message }} @enderror</div>
                    </div>

                    <!-- Payment Gateway -->
                    <div class="col-md-6">

                        <label class="form-label" for="payment_gateway">{{ __('Payment Gateway') }}</label> *
                        <select required class="form-control @error('payment_gateway') is-invalid @enderror"
                                name="payment_gateway">
                            <option value="bank"
                                    @if($thisData->payment_gateway == 'bank') selected @endif>{{ __('Bank') }}</option>
                            <option value="esewa"
                                    @if($thisData->payment_gateway == 'esewa') selected @endif>{{ __('Esewa') }}</option>
                            <option value="khalti"
                                    @if($thisData->payment_gateway == 'khalti') selected @endif>{{ __('Khalti') }}</option>
                        </select>
                        <div class="invalid-feedback">@error('payment_gateway') {{ $message }} @enderror</div>
                    </div>

                    <!-- Mobile Number -->
                    <div class="col-md-6">
                        <label class="form-label" for="mobile_number">{{ __('Mobile Number') }}</label> *
                        <input required type="text" name="mobile_number" id="mobile_number"
                               value="{{ $thisData->mobile_number ?? old('mobile_number') }}"
                               class="form-control @error('mobile_number') is-invalid @enderror"
                               placeholder="Mobile Number"/>
                        <div class="invalid-feedback">@error('mobile_number') {{ $message }} @enderror</div>
                    </div>

                    <!-- Bank Details (conditional fields) -->
                    <!-- Bank Name -->
                    <div class="col-md-6 bank-details">
                        <label class="form-label" for="bank_name">{{ __('Bank Name') }}</label> *
                        <input required type="text" name="bank_name" id="bank_name"
                               value="{{ $thisData->bank_name ?? old('bank_name') }}"
                               class="form-control @error('bank_name') is-invalid @enderror" placeholder="Bank Name"/>
                        <div class="invalid-feedback">@error('bank_name') {{ $message }} @enderror</div>
                    </div>

                    <!-- Bank Account Name -->
                    <div class="col-md-6 bank-details">
                        <label class="form-label" for="bank_account_name">{{ __('Bank Account Name') }}</label> *
                        <input required type="text" name="bank_account_name" id="bank_account_name"
                               value="{{ $thisData->bank_account_name ?? old('bank_account_name') }}"
                               class="form-control @error('bank_account_name') is-invalid @enderror"
                               placeholder="Bank Account Name"/>
                        <div class="invalid-feedback">@error('bank_account_name') {{ $message }} @enderror</div>
                    </div>

                    <!-- Bank Swift Code -->
                    <div class="col-md-6 bank-details">
                        <label class="form-label" for="bank_swift_code">{{ __('Bank Swift Code') }}</label> *
                        <input required type="text" name="bank_swift_code" id="bank_swift_code"
                               value="{{ $thisData->bank_swift_code ?? old('bank_swift_code') }}"
                               class="form-control @error('bank_swift_code') is-invalid @enderror"
                               placeholder="Bank Swift Code"/>
                        <div class="invalid-feedback">@error('bank_swift_code') {{ $message }} @enderror</div>
                    </div>

                    <!-- Bank Address -->
                    <div class="col-md-6 bank-details">
                        <label class="form-label" for="bank_address">{{ __('Bank Address') }}</label> *
                        <input required type="text" name="bank_address" id="bank_address"
                               value="{{ $thisData->bank_address ?? old('bank_address') }}"
                               class="form-control @error('bank_address') is-invalid @enderror"
                               placeholder="Bank Address"/>
                        <div class="invalid-feedback">@error('bank_address') {{ $message }} @enderror</div>
                    </div>

                    <!-- Bank Account Number -->
                    <div class="col-md-6 bank-details">
                        <label class="form-label" for="bank_account_number">{{ __('Bank Account Number') }}</label> *
                        <input required type="text" name="bank_account_number" id="bank_account_number"
                               value="{{ $thisData->bank_account_number ?? old('bank_account_number') }}"
                               class="form-control @error('bank_account_number') is-invalid @enderror"
                               placeholder="Bank Account Number"/>
                        <div class="invalid-feedback">@error('bank_account_number') {{ $message }} @enderror</div>
                    </div>
                    <!-- Status -->
                    <div class="col-md-6">
                        <label class="form-label w-100" for="status">{{ __('Status') }}</label>
                        <div class="form-check-inline">
                            <input type="radio" id="status1" name="status" value="1" checked
                                   class="form-check-input @error('status') is-invalid @enderror"
                                   @if(($thisData->status ?? old('status')) == '1') checked @endif>
                            <label for="status1" class="form-check-label">{{ __('Active') }}</label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" id="status2" name="status" value="0"
                                   class="form-check-input @error('status') is-invalid @enderror"
                                   @if(($thisData->status ?? old('status')) == '0') checked @endif>
                            <label for="status2" class="form-check-label">{{ __('Inactive') }}</label>
                        </div>
                        <div class="invalid-feedback">@error('status') {{ $message }} @enderror</div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('Update') }}</button>
                </div>

            </form>
        </div>
    </div>

    <script>
        let paymentType = "{{$thisData->payment_gateway}}";
        if (paymentType == 'bank') {
            $('.bank-details').show();
            $('.bank-details input').attr('required', 'required');

        } else {
            $('.bank-details input').removeAttr('required');
            $('.bank-details').hide();
        }
        document.querySelector('select[name="payment_gateway"]').addEventListener('change', function () {
            if (this.value == 'bank') {
                $('.bank-details').show();
                $('.bank-details input').attr('required', 'required');
            } else {
                $('.bank-details input').removeAttr('required');
                $('.bank-details').hide();
            }
        });
    </script>
@endsection
