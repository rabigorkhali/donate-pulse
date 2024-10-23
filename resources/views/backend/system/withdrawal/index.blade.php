@extends('backend.system.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('backend.system.partials.errors')
        <div class="card mb-4">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card">

                <div class="card-datatable table-responsive">
                    <form method="get" action="{{ route('withdrawals.index') }}">
                        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row me-2">
                                <div class="col-md-2">
                                    <div class="me-3">
                                        <div class="">
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
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Status:
                                    <select name="withdrawal_status" class="form-select">
                                        <option value="">{{ __('Select Status') }}</option>
                                        <option value="pending"
                                                @if (request('withdrawal_status') == 'pending') selected @endif>Pending
                                        </option>
                                        <option value="rejected"
                                                @if (request('withdrawal_status') == 'rejected') selected @endif>
                                            Rejected
                                        </option>
                                        <option value="cancelled"
                                                @if (request('withdrawal_status') == 'cancelled') selected @endif>
                                            Cancelled
                                        </option>
                                        <option value="successful"
                                                @if (request('withdrawal_status') == 'successful') selected @endif>
                                            Successful
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    From Request Date: <input type="date" name="from_date" class="form-control"
                                                              value="{{request('from_date')}}">
                                </div>
                                <div class="col-md-3">
                                    To Request Date: <input type="date" name="to_date" class="form-control"
                                                            value="{{request('to_date')}}">

                                </div>
                                <div class="col-md-3">
                                    Mobile Number:
                                    <input type="text" value="{{ request('mobile_number') }}" name="mobile_number"
                                           class="form-control" placeholder="Search...">
                                </div>

                                @if(authUser()->role->name!=='public-user')
                                    <div class="col-md-3 "> User:
                                        <select name="user_id" class="form-select">
                                            <option value="">{{ __('Select User') }}</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}"
                                                        @if (request('user_id') == $user->id) selected @endif>
                                                    {{ ucfirst($user->name) }} ({{$user->email}})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div class="col-md-3 mt-4 mb-2">
                                    <button type="submit" class="btn btn-primary ">
                                        <span><i class="ti ti-filter me-1 ti-xs"></i>Filter</span>
                                    </button>
                                    <a href="{{route('withdrawals.index')}}" class="btn btn-primary ">
                                        <span><i class="ti ti-clear-all me-1 ti-xs"></i>Clear</span>
                                    </a>
                                    @if(hasPermission('/'.strtolower($title).'/*','put'))
                                        <a class="btn add-new btn-primary text-white"
                                           href="{{ route(strtolower($title).'.create') }}">
                                            <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                            <span class="d-none d-sm-inline-block">Add</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <table class="datatables table dataTable no-footer dtr-column" id="DataTables_Table_0"
                                   aria-describedby="DataTables_Table_0_info">
                                <thead class="border-top">
                                <tr>
                                    <th>{{ __('SN') }}</th>
                                    <th>{{ __('Campaign') }}</th>
                                    <th>{{ __('Amount(Rs.)') }}</th>
                                    <th>{{ __('Payment Gateway') }}</th>
                                    <th>{{ __('Mobile Number') }}</th>
                                    <th>{{ __('Requested At') }}</th>
                                    <th>{{ __('Campaign Status') }}</th>
                                    <th>{{ __('Withdrawal Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @if (!$thisDatas->count())
                                    <tr>
                                        <td class="text-center" colspan="8">{{ __('No data found.') }}</td>
                                    </tr>
                                @endif
                                @foreach ($thisDatas as $key => $withdrawal)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td>
                                            {{ $withdrawal->campaign->title}}<br>
                                        </td>
                                        <td>
                                            Gross: {{ $withdrawal->campaignView->summary_total_collection}} <br>
                                            Service
                                            Charge: {{ $withdrawal->campaignView->summary_service_charge_amount}} <br>
                                            Net: {{ $withdrawal->campaignView->net_amount_collection}} <br>
                                        </td>
                                        <td>{{ ucfirst($withdrawal->paymentGateway->payment_gateway??'-') }} <br>
                                        </td>
                                        <td>{{ $withdrawal->paymentGateway->mobile_number??'-' }}</td>
                                        <td>{{ $withdrawal->created_at }}<br>
                                        </td>
                                        <td>{{ ucfirst($withdrawal->campaign->campaign_status) }}</td>
                                        <td>{{ ucfirst($withdrawal->withdrawal_status) }}</td>
                                        <td>
                                            @if($withdrawal->withdrawal_status=='pending')
                                                @if(hasPermission('/withdrawals/*', 'put') || hasPermission('/withdrawals/*', 'delete'))
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            @if(hasPermission('/'.strtolower($title).'/*','put'))
                                                                <a class="dropdown-item"
                                                                   href="{{route('withdrawals.edit',$withdrawal->id)}}"><i
                                                                        class="ti ti-pencil me-1"></i>{{__('Edit')}}</a>
                                                            @endif
                                                            @if(hasPermission('/withdrawals/*', 'delete'))
                                                                <a href="#" class="dropdown-item delete-button"
                                                                   data-bs-toggle="modal"
                                                                   data-actionurl="{{ route('withdrawals.destroy', $withdrawal->id) }}"
                                                                   data-bs-target="#deleteModal">
                                                                    <i class="ti ti-trash me-1"></i>{{ __('Delete') }}
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
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
