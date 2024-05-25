@extends('admin.master_layout')
@section('title')
    <title>{{ __('Dashboard') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Dashboard') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Total Orders') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalOrders }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-info">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Total Customers') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalCustomers }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-list"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Total Products') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $products }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-money-bill"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Total Income') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ currency($totalIncomes) }} @if (!$totalIncomes)
                                        0.00
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-info">
                                <i class="fas fa-cart-arrow-down"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Total Orders(30 Days)') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $last30DaysOrders }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-cart-plus"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Today Orders') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $data['todaysOrders'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- @adminCan('order.list') --}}
                    <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Recent Orders') }}</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('admin.orders') }}" class="btn btn-primary">{{ __('View All') }}</a>
                                </div>
                            </div>
                            <div class="p-0 card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('User') }}</th>
                                                <th>{{ __('Delivery Method') }}</th>
                                                <th>{{ __('Price') }}</th>
                                                <th>{{ __('Payment') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data['recentOrders'] as $history)
                                                <tr>
                                                    <td>
                                                        @if ($history?->user?->name)
                                                            <a
                                                                href="{{ route('admin.order.show', $history->id) }}">{{ $history?->user?->name }}</a>
                                                        @else
                                                            Anonymous
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-info">
                                                            {{ $history->delivery_method == 1 ? __('Delivery') : __('Pickup') }}
                                                        </div>
                                                    </td>
                                                    <td>{{ currency($history->total_amount) }}</td>
                                                    <td>
                                                        @if ($history->payment_status == 'pending')
                                                            <div class="badge badge-warning">
                                                                {{ __('Pending') }}
                                                            </div>
                                                        @elseif ($history->payment_status == 'success')
                                                            <div class="badge badge-success">
                                                                {{ __('Success') }}
                                                            </div>
                                                        @else
                                                            <div class="badge badge-danger">
                                                                {{ __('Rejected') }}
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">{{ __('No data found') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @endadminCan --}}
                    {{-- @adminCan('customer.view') --}}
                    <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Recent User') }}</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('admin.all-customers') }}"
                                        class="btn btn-primary">{{ __('View All') }}</a>
                                </div>
                            </div>
                            <div class="p-0 card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Joined at') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data['latestCustomers'] as $user)
                                                <tr>
                                                    <td>{{ html_decode($user->name) }}</td>
                                                    <td>{{ $user->created_at->format('h:iA, d M Y') }}</td>
                                                    <td>
                                                        @if ($user->email_verified_at)
                                                            @if ($user->is_banned == 'no')
                                                                <span
                                                                    class="badge badge-success">{{ __('Active') }}</span>
                                                            @else
                                                                <b class="badge badge-danger">{{ __('Banned') }}</b>
                                                            @endif
                                                        @else
                                                            <span
                                                                class="badge badge-warning">{{ __('Not verified') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.customer-show', $user->id) }}"
                                                            class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">{{ __('No data found') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @endadminCan --}}
                </div>
            </div>
        </section>
    </div>

@endsection
