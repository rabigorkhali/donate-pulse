@extends('backend.system.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('backend.system.partials.errors')
        <div class="card mb-4">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card">

                <div class="card-datatable table-responsive">
                    <form method="get" action="{{ route('donations.index') }}">
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
                                                <select name="donor_user_id" class="form-select">
                                                    <option value="">{{ __('Select Donor') }}</option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}"
                                                                @if (request('donor_user_id') == $user->id) selected @endif>
                                                            {{ ucfirst($user->name) }} ({{$user->email}})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </label>
                                        </div>
                                        <div class="dataTables_filter ml-2">
                                            <label>
                                                <select name="receiver_user_id" class="form-select">
                                                    <option value="">{{ __('Select Receiver') }}</option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}"
                                                                @if (request('receiver_user_id') == $user->id) selected @endif>
                                                            {{ ucfirst($user->name) }} ({{$user->email}})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </label>
                                        </div>
                                        <div class="dataTables_filter">
                                            <label>From:
                                                <input type="date" name="from_date" class="form-control" value="{{request('from_date')}}">
                                            </label>
                                        </div>
                                        <div class="dataTables_filter">
                                            <label>To:
                                                <input type="date" name="to_date" class="form-control" value="{{request('to_date')}}">
                                            </label>
                                        </div>
                                        <div class="dataTables_filter">
                                            <label>
                                                <input type="text" value="{{ request('keyword') }}" name="keyword"
                                                       class="form-control" placeholder="Search Mobile Number...">
                                            </label>
                                        </div>
                                        <div class="dataTables_filter">
                                            <label>
                                                <select name="payment_gateway" class="form-select">
                                                    <option value="">{{ __('Select Payment Gateway') }}</option>
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
                                            </label>
                                        </div>
                                        <div class="dt-buttons btn-group flex-wrap">
                                            <button type="submit" class="btn btn-primary mx-3">
                                                <span><i class="ti ti-filter me-1 ti-xs"></i>Filter</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="datatables table dataTable no-footer dtr-column" id="DataTables_Table_0"
                                   aria-describedby="DataTables_Table_0_info">
                                <thead class="border-top">
                                <tr>
                                    <th>{{ __('SN') }}</th>
                                    <th>{{ __('Donor') }}</th>
                                    <th>{{ __('Receiver') }}</th>
                                    <th>{{ __('Campaign Details') }}</th>
                                    <th>{{ __('Amount(Rs.)') }}</th>
                                    <th>{{ __('Payment Gateway') }}</th>
                                    <th>{{ __('Mobile Number') }}</th>
                                    <th>{{ __('Transaction') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @if (!$thisDatas->count())
                                    <tr>
                                        <td class="text-center" colspan="8">{{ __('No data found.') }}</td>
                                    </tr>
                                @endif
                                @foreach ($thisDatas as $key => $donation)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><b>Name:</b>{{ $donation->giver->name }}<br>
                                            <b>Email:</b>{{ $donation->giver->email }}<br>
                                            <b>Contact:</b>{{ $donation->giver->phone_number }}<br>
                                        </td>
                                        <td><b>Name:</b>{{ $donation->receiver->name }}<br>
                                            <b>Email:</b>{{ $donation->receiver->email }}<br>
                                            <b>Contact:</b>{{ $donation->receiver->phone_number }}<br>
                                        </td>
                                        <td>
                                            Name:{{ $donation->campaign->title}}<br>
                                            Status:{{ ucfirst($donation->campaign->campaign_status)}}

                                        </td>
                                        <td>{{ $donation->amount}}</td>
                                        <td>{{ ucfirst($donation->payment_gateway??'-') }}</td>
                                        <td>{{ $donation->mobile_number }}</td>
                                        <td><b>Date:</b>{{ $donation->created_at }}<br>
                                            <b>ID:</b>{{ $donation->transaction_id }}<br>
                                        </td>
                                        <td>{{ ucfirst($donation->payment_status) }}</td>
                                        <td>
                                            @if(hasPermission('/donations/*', 'put') || hasPermission('/donations/*', 'delete'))
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @if(hasPermission('/donations/*', 'delete'))
                                                            <a href="#" class="dropdown-item delete-button"
                                                               data-bs-toggle="modal"
                                                               data-actionurl="{{ route('donations.destroy', $donation->id) }}"
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
