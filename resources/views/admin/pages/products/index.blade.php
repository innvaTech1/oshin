@extends('admin.master_layout')

@section('title')
    <title>{{ __('Product List') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Product List') }}</h1>
            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Brand') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $product->product_name }}</td>
                                                    <td>{{ $product->brand->name }}</td>

                                                    <td>
                                                        <a href="{{ route('admin.product.edit', ['product' => $product->id]) }}"
                                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"
                                                                aria-hidden="true"></i></a>

                                                        <div class="dropdown d-inline">
                                                            <button class="btn btn-primary btn-sm dropdown-toggle"
                                                                type="button" id="dropdownMenuButton2"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fas fa-cog"></i>
                                                            </button>
                                                            <button type="button" data-toggle="modal"
                                                                @if ($product->orders->count() > 0) data-target="#canNotDeleteModal"
                                                                @else
                                                                data-target="#deleteModal" onclick="deleteData({{ $product->id }})" @endif
                                                                class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </button>

                                                            <div class="dropdown-menu" x-placement="top-start"
                                                                style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -131px, 0px);">
                                                                <a class="dropdown-item has-icon"
                                                                    href="{{ route('admin.product-gallery', $product->id) }}"><i
                                                                        class="far fa-image"></i>
                                                                    {{ __('Image Gallery') }}</a>

                                                                <a class="dropdown-item has-icon"
                                                                    href="{{ route('admin.related-products', $product->id) }}"><i
                                                                        class="fas fa-lightbulb"></i>
                                                                    {{ __('Related Products') }}</a>

                                                                <a class="dropdown-item has-icon"
                                                                    href="{{ route('admin.product-variant', $product->id) }}"><i
                                                                        class="fas fa-cog"></i>{{ __('Product Variant') }}</a>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
