@extends('admin.master_layout')
@section('title')
    <title>{{ __('Product Inventory') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Product Inventory') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    <a href="{{ route('admin.product.create') }}" class="btn btn-primary"><i
                                            class="fa fa-plus"></i>
                                        {{ __('Product Inventory ') }}</a>
                                </h4>
                            </div>
                            <div class="card-body text-center">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">{{ __('SN') }}</th>
                                                <th width="30%">{{ __('Image') }}</th>
                                                <th width="10%">{{ __('Products') }}</th>
                                                <th width="15%">{{ __('QUANTITY') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($products as $index => $product)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td> <img class="rounded-circle" src="{{ asset($product->image_url) }}"
                                                            alt="" width="100px" height="100px"></td>
                                                    <td>{{ $product->name }}
                                                    </td>
                                                    <td>
                                                        <input type="number" name="quantity" value="">
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $products->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


@push('js')
    <script>
        
    </script>
@endpush
