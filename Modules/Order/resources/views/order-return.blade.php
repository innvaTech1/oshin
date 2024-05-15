@extends('admin.master_layout')
@section('title')
    <title>{{ $title }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $title }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="GET" onchange="this.submit()" class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <input type="text" name="search" value="{{ request()->get('search') }}"
                                                class="form-control" placeholder="{{ __('Search') }}">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <select name="order_by" id="order_by" class="form-control">
                                                <option value="">{{ __('Order By') }}</option>
                                                <option value="1" {{ request('order_by') == '1' ? 'selected' : '' }}>
                                                    {{ __('ASC') }}
                                                </option>
                                                <option value="0" {{ request('order_by') == '0' ? 'selected' : '' }}>
                                                    {{ __('DESC') }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <select name="par-page" id="par-page" class="form-control">
                                                <option value="">{{ __('Per Page') }}</option>
                                                <option value="10" {{ '10' == request('par-page') ? 'selected' : '' }}>
                                                    {{ __('10') }}
                                                </option>
                                                <option value="50" {{ '50' == request('par-page') ? 'selected' : '' }}>
                                                    {{ __('50') }}
                                                </option>
                                                <option value="100"
                                                    {{ '100' == request('par-page') ? 'selected' : '' }}>
                                                    {{ __('100') }}
                                                </option>
                                                <option value="all"
                                                    {{ 'all' == request('par-page') ? 'selected' : '' }}>
                                                    {{ __('All') }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <input type="text" name="from" class="form-control datepicker"
                                                placeholder="From" value="{{ request()->from }}">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <input type="text" name="to" class="form-control datepicker"
                                                placeholder="To" value="{{ request()->to }}">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th width="5%">{{ __('SN') }}</th>
                                            <th width="10%">{{ __('Customer') }}</th>
                                            <th width="10%">{{ __('Order Id') }}</th>
                                            <th width="10%">{{ __('Request Date') }}</th>
                                            <th width="10%">{{ __('reason') }}</th>
                                            <th width="10%">{{ __('Amount') }}</th>
                                            <th width="10%">{{ __('Return Status') }}</th>
                                            <th width="10%">{{ __('Payment Status') }}</th>
                                            <th width="15%">{{ __('Action') }}</th>
                                        </tr>
                                        @forelse ($returns as $index => $return)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>
                                                    {{ $return?->user?->name }}
                                                </td>
                                                <td>{{ $return->order_id }}</td>
                                                <td>{{ $return->created_at->format('d F, Y') }}</td>
                                                <td>{{ $return->reason }}</td>
                                                <td>{{ $return->order->total_amount }}</td>

                                                <td>
                                                    <span
                                                        class="badge badge-warning">{{ $return->status }}
                                                    </span>

                                                </td>
                                                <td>
                                                   <span
                                                        class="badge badge-warning">{{ $return->payment_status }}
                                                    </span>
                                                </td>
                                                <td class="d-flex justify-content-center align-items-center">
                                                    <a href="javascript:;" data-toggle="modal" {{-- data-target="#deleteModal" --}}
                                                        class="btn btn-danger btn-sm mr-2"
                                                        onclick="deleteData({{ $return->order_id }})"><i class="fa fa-trash"
                                                            aria-hidden="true"></i></a>
                                                    <a href="javascript:;" data-toggle="modal" data-target="#status"
                                                        class="btn btn-warning btn-sm status-btn">
                                                        <i class="fas fa-truck"
                                                            aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <x-empty-table :name="__('Return Order')" route="" create="no" :message="__('No data found!')"
                                                colspan="7"></x-empty-table>
                                        @endforelse
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('components.admin.preloader')

    @foreach ($returns as $return)
    <div class="modal fade" tabindex="-1" role="dialog" id="status">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('admin.order.return') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Status') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="order_id" value="{{ $return->order_id }}">
                        <div class="form-group">
                            <label for="return_status">{{ __('Return Status') }}</label>
                            <select name="return_status" class="form-control" id="return_status">
                                <option value="pending" @if ($return?->status == 'pending') selected @endif>
                                    {{ __('Pending') }}</option>
                                <option value="approved" @if ($return?->status == 'approved') selected @endif>
                                    {{ __('Approved') }}</option>
                                <option value="rejected" @if ($return?->status == 'rejected') selected @endif>
                                    {{ __('Rejected') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="payment_status">{{ __('Payment Status') }}</label>
                            <select name="payment_status" class="form-control" id="payment_status">
                                <option value="pending" @if ($return?->payment_status == 'rejected') selected @endif>
                                    {{ __('Pending') }}</option>
                                <option value="approved" @if ($return?->payment_status == 'approved') selected @endif>
                                    {{ __('Re Funded') }}</option>
                                <option value="rejected" @if ($return?->payment_status == 'rejected') selected @endif>
                                    {{ __('Rejected') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="reason">{{ __('Return Reason') }}<span class="text-danger">*</span></label>
                            <textarea name="reason" class="form-control height_50" id="reason" required>{{ $return?->reason }}</textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach
@endsection
