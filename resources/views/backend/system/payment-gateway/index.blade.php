@extends('backend.system.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('backend.system.partials.errors')
        <div class="card mb-4">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card">

                <div class="card-datatable table-responsive">
                    <form method="get" action="{{ route('payment-gateways.index') }}">
                        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row me-2">
                                <div class="col-md-2">
                                    <div class="me-3">
                                        <div class="dataTables_length">
                                            <label>
                                                <select name="show" class="form-select">
                                                    <option value="10" @if (request('show') == 10) selected @endif>10
                                                    </option>
                                                    <option value="25" @if (request('show') == 25) selected @endif>25
                                                    </option>
                                                    <option value="50" @if (request('show') == 50) selected @endif>50
                                                    </option>
                                                    <option value="100" @if (request('show') == 100) selected @endif>
                                                        100
                                                    </option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div
                                        class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                                        <div class="dataTables_filter">
                                            <label>
                                                <input type="text" value="{{ request('keyword') }}" name="keyword"
                                                       class="form-control" placeholder="Search...">
                                            </label>
                                        </div>
                                        <div class="dt-buttons btn-group flex-wrap">
                                            <div class="btn-group">
                                                <button type="submit" class="btn btn-primary mx-3">
                                                    <span><i class="ti ti-filter me-1 ti-xs"></i>Filter</span>
                                                </button>
                                                @if(hasPermission('/payment-gateways/*', 'put'))
                                                    <a class="btn add-new btn-primary text-white"
                                                       href="{{ route('payment-gateways.create') }}">
                                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                                        <span class="d-none d-sm-inline-block">Add</span>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="datatables table dataTable no-footer dtr-column" id="DataTables_Table_0"
                                   aria-describedby="DataTables_Table_0_info">
                                <thead class="border-top">
                                <tr>
                                    <th>{{ __('SN') }}</th>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Payment Gateway') }}</th>
                                    <th>{{ __('Mobile Number') }}</th>
                                    <th>{{ __('Bank Details') }}</th>

                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @if (!$thisDatas->count())
                                    <tr>
                                        <td class="text-center" colspan="5">{{ __('No data found.') }}</td>
                                    </tr>
                                @endif
                                @foreach ($thisDatas as $paymentKey => $payment)
                                    <tr>
                                        <td>{{ $paymentKey + 1 }}</td>
                                        <td>{{ $payment->user->name }} ({{$payment->user->email}})</td>
                                        <td>{{ ucfirst($payment->payment_gateway) }}</td>
                                        <td>{{ $payment->mobile_number }}</td>
                                        <td>
                                            @if($payment->payment_gateway=='bank')
                                                Bank Name: {{ $payment->bank_name }}<br>
                                                Account Name: {{ $payment->bank_account_name }}<br>
                                                Account Number: {{ $payment->bank_account_number }}<br>
                                                Address: {{ $payment->bank_address }}<br>
                                                Swift Code: {{ $payment->bank_swift_code }}</td>
                                            @else
                                                -
                                           @endif
                                        <td>
                                            @if(hasPermission('/payment-gateways/*', 'put') || hasPermission('/payment-gateways/*', 'delete'))
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">

                                                        @if(hasPermission('/payment-gateways/*', 'delete'))
                                                            <a href="#" class="dropdown-item delete-button"
                                                               data-bs-toggle="modal"
                                                               data-actionurl="{{ route('payment-gateways.destroy', $payment->id) }}"
                                                               data-bs-target="#deleteModal">
                                                                <i class="ti ti-trash me-1"></i>{{ __('Delete') }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row mx-2">
                                <div class="row">
                                    <div class="col">
                                        <nav>
                                            {{ $thisDatas->appends(request()->query())->links('pagination::bootstrap-4') }}
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
