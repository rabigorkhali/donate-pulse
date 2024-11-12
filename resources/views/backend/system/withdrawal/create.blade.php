@extends('backend.system.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('backend.system.partials.errors')
        <div class="card mb-4">
            <h5 class="card-header">{{ __('Create Withrawal') }}</h5>
            <form class="card-body" action="{{ route('withdrawals.store') }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <!-- Campaign ID -->
                    <div class="col-md-6">
                        <label class="form-label" for="campaign_id">{{ __('Campaign') }}</label> *
                        <select required class="form-control select2 @error('campaign_id') is-invalid @enderror"
                                name="campaign_id" id="campaign_id">
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
                                name="payment_gateway_id" id="payment_gateway_id">
                            <option value="">{{ __('Select Payment Gateway') }}</option>
                            @foreach($paymentGateways as $paymentGateway)
                                <option @if(old('payment_gateway_id') == $paymentGateway->id) selected
                                        @endif value="{{ $paymentGateway->id }}"

                                        data-bank-account-number="{{ $paymentGateway->bank_account_number }}"
                                        data-bank-name="{{ $paymentGateway->bank_name }}"
                                        data-payment-gateway-name="{{ $paymentGateway->payment_gateway }}"
                                        data-mobile-number="{{ $paymentGateway->mobile_number }}"
                                >
                                    {{ ucfirst($paymentGateway->payment_gateway) }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">@error('payment_gateway_id') {{ $message }} @enderror</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 d-none" id="campaign_details_div">
                            <div class="table-responsive">
                                <hr>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <h5 class="ml-2">Campaign Details</h5>
                                    </tr>

                                    <tr>
                                        <th style="width:20%">Goal Amount:</th>
                                        <td class="campaign-data" id="goal_amount">N/A</td>
                                    </tr>
                                    <tr>
                                        <th style="width:20%">Total Donation Amount:</th>
                                        <td class="campaign-data" id="summary_total_collection">N/A</td>
                                    </tr>
                                    <tr>
                                        <th style="width:20%">Net Donation Amount:</th>
                                        <td class="campaign-data" id="net_amount_collection">N/A</td>
                                    </tr>
                                    <tr>
                                        <th style="width:20%">Applicable Service charge:</th>
                                        <td class="campaign-data" id="summary_service_charge_amount">N/A</td>
                                    </tr>
                                    <tr>
                                        <th style="width:20%">Total Donors:</th>
                                        <td class="campaign-data" id="total_number_donation">N/A</td>
                                    </tr>
                                    <tr>
                                        <th style="width:20%">Start Date:</th>
                                        <td class="campaign-data" id="start_date">N/A</td>
                                    </tr>
                                    <tr>
                                        <th style="width:20%">End Date:</th>
                                        <td class="campaign-data" id="end_date">N/A</td>
                                    </tr>
                                    <tr>
                                        <th style="width:20%">Campaign Status:</th>
                                        <td class="campaign-data" id="end_date">Completed</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 d-none" id="payment_details_div">
                            <div class="table-responsive">
                                <hr>

                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <h5 class="ml-2">Payment Details</h5>

                                    </tr>
                                    <tr>
                                        <th style="width:20%">Type:</th>
                                        <td id="info_payment_type">
                                            N/A
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:20%">Mobile Number:</th>
                                        <td id="info_payment_mobile_number">
                                            N/A
                                        </td>
                                    </tr>
                                    <tr class="bank-attr">
                                        <th style="width:20%">Bank Name:</th>
                                        <td id="info_bank_name">
                                            N/A
                                        </td>
                                    </tr>
                                    <tr class="bank-attr">
                                        <th style="width:20%">Bank Account Number:</th>
                                        <td id="info_bank_account_number">
                                            N/A
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // $('#description').summernote({
        //     height: 400, // set editor height
        //     width: 1140, // set editor height
        //     focus: true
        // });

        $(document).ready(function() {
            $('#campaign_id').change();

            function getCompaignDetails(campaignId) {

                let fetchUrl = "{{ url(getSystemPrefix().'/campaigns-summary/') }}" + '/' + campaignId;
                $.ajax({
                    url: fetchUrl, // Replace with the API endpoint URL
                    type: 'GET',
                    dataType: 'json', // The expected data type in the response
                    success: function(data) {
                        $('#goal_amount').text(data.campaign.goal_amount);
                        $('#summary_total_collection').text(data.campaign.summary_total_collection);
                        $('#net_amount_collection').text(data.campaign.net_amount_collection);
                        $('#summary_service_charge_amount').text(data.campaign
                            .summary_service_charge_amount);
                        $('#total_number_donation').text(data.campaign.total_number_donation);
                        $('#start_date').text(data.campaign.start_date_format);
                        $('#end_date').text(data.campaign.end_date_format);
                        $('#campaign_details_div').removeClass('d-none');
                        $('#payment_details_div').removeClass('d-none');

                    },
                    error: function(xhr, status, error) {
                        // This function will be called if there's an error in the request
                        // Handle the error here
                        console.error(error);
                    }
                });
            }

            $('#campaign_id').change(function() {
                let campaignId = $('#campaign_id').val();
                $('#campaign_details_div').addClass('d-none');
                $('#payment_details_div').addClass('d-none');
                if (campaignId !== 'none') {
                    getCompaignDetails(campaignId);
                }
                $('#info_bank_name').text($('#payment_gateway_id option:selected').data('bank-name'));
                $('#info_payment_mobile_number').text($('#payment_gateway_id option:selected').data(
                    'mobile-number'));
                $('#info_bank_account_number').text($('#payment_gateway_id option:selected').data(
                    'bank-account-number'));
                $('#info_payment_type').text($('#payment_gateway_id option:selected').text().trim());
                let selectedPaymentGateway = $('#payment_gateway_id option:selected').data(
                    'payment-gateway-name').trim();
                if (selectedPaymentGateway == 'bank' || selectedPaymentGateway ==
                    'Bank (National/International)') {
                    $('.bank-attr').show();
                } else {
                    $('.bank-attr').hide();
                }
            });

            $('#payment_gateway_id').change(function() {
                let campaignId = $('#campaign_id').val();

                if (campaignId !== 'none') {
                    getCompaignDetails(campaignId);
                    $('#info_bank_name').text($('#payment_gateway_id option:selected').data(
                        'bank-name'));
                    $('#info_payment_mobile_number').text($('#payment_gateway_id option:selected')
                        .data('mobile-number'));
                    $('#info_bank_account_number').text($('#payment_gateway_id option:selected').data(
                        'bank-account-number'));
                    $('#info_payment_type').text($('#payment_gateway_id option:selected').text()
                        .trim());
                    $('#info_payment_type').text($('#payment_gateway_id option:selected').text()
                        .trim());
                    let selectedPaymentGateway = $('#payment_gateway_id option:selected').data(
                        'payment-gateway-name').trim();
                    if (selectedPaymentGateway == 'bank' || selectedPaymentGateway ==
                        'Bank (National/International)') {
                        $('.bank-attr').show();
                    } else {
                        $('.bank-attr').hide();
                    }
                }
            });

        });
    </script>
@endsection
