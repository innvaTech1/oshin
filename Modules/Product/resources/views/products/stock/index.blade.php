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
                                                <th width="20%">{{ __('Image') }}</th>
                                                <th width="60%" class="text-left">{{ __('Products') }}</th>
                                                <th width="15%">{{ __('QUANTITY') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($products as $index => $product)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td> <img class="rounded-circle" src="{{ asset($product->image_url) }}"
                                                            alt="" width="100px" height="100px"></td>
                                                    <td class="text-left">{{ $product->name }}
                                                    </td>
                                                    
                                                    <td>
                                                        @if (!$product->has_variant)
                                                        <input type="number" name="quantity" value="{{ $item?->stock?->quantity }}"
                                                            class="form-control" data-sku="{{ $item->sku }}">
                                                        @endif
                                                        
                                                    </td>
                                                </tr>
                                                @foreach ($product->variants as $item)
                                                    <tr>
                                                        <td>{{ ++$index }}</td>
                                                        <td></td>
                                                        <td class="text-left">
                                                            <span>
                                                                ↳ {{ $item->attributes() }}
                                                            </span>
                                                            <small>
                                                                {{$item->sku}}
                                                            </small>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="quantity" value="{{$item?->stock?->quantity}}"
                                                                class="form-control" data-sku="{{ $item->sku }}" data-product_id="{{$product->id}}">
                                                        </td>
                                                    </tr>
                                                @endforeach
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
    @include('components.admin.preloader')
@endsection


@push('js')
    <script>
        "use strict";

        $("[name='quantity']").on('blur',function(){
            $('.preloader_area').removeClass('d-none');
            let quantity = $(this).val();
            let sku = $(this).data('sku');
            const product_id = $(this).data('product_id');
            $.ajax({
                url: "{{ route('admin.product.inventory.update') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    sku: sku,
                    quantity: quantity,
                    product_id : product_id,
                },
                success: function(response) {
                    iziToast.success({
                        title: 'Success',
                        message: "Updated Successfully",
                        position: 'topRight'
                    });

                    $('.preloader_area').addClass('d-none');
                },
                error: function(response) {
                    iziToast.error({
                        title: 'Error',
                        message: response.responseJSON.message,
                        position: 'topRight'
                    });

                    $('.preloader_area').addClass('d-none');
                }
            });
        })
    </script>
@endpush
