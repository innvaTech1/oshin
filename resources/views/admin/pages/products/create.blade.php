@extends('admin.master_layout')
@section('title')
    <title>{{ __('Create Product') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Create product') }}</h1>
            </div>

            <div class="section-body">
                <a href="{{ route('admin.product.index') }}" class="btn btn-primary"><i class="fas fa-list"></i>
                    {{ __('Product List') }}</a>
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-4">
                        <div class="col-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="section-title">Product Information</h3>
                                        </div>
                                        <div class="form-group col-12">
                                            <label class="d-block">Type</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="Single" value="single"
                                                    name="type">
                                                <label class="form-check-label" for="Single">Single</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="Variant"
                                                    value="variant" name="type">
                                                <label class="form-check-label" for="Variant">Variant</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="name" class="form-control" name="name">
                                        </div>

                                        <div class="form-group col-6">
                                            <label>{{ __('Product SKU') }}</label>
                                            <input type="text" id="productSku" class="form-control" name="product_sku">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>{{ __('Variant SKU Prefix') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="variant_sku_prefix" class="form-control"
                                                name="variant_sku_prefix">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>{{ __('Model Number') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="model_number" class="form-control"
                                                name="model_number">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>{{ __('Category') }} <span class="text-danger">*</span></label>
                                            <select name="category_ids[]" id="" class="form-control select2"
                                                multiple>
                                                <option value="" disabled>Select</option>
                                                @foreach ($data['categories'] as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>{{ __('Brand') }} </label>
                                            <select name="brand_id" id="" class="form-control select2">
                                                <option value="" disabled selected>Select</option>
                                                @foreach ($data['brands'] as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>{{ __('Unit') }} <span class="text-danger">*</span></label>
                                            <select name="unit_id" id="" class="form-control select2">
                                                <option value="" disabled selected>Select</option>
                                                @foreach ($data['units'] as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>{{ __('Minimum Order Qty') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="min_order_qty">
                                        </div>
                                        <div class="form-group col-3">
                                            <label>{{ __('Maximum Order Qty') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="max_order_qty">
                                        </div>

                                        <div class="form-group col-9">
                                            <label>{{ __('Tags') }} </label>
                                            <input type="text" class="form-control tags" name="tags">
                                        </div>

                                        <div class="form-group col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_physical"
                                                    id="is_physical" value="1" checked>
                                                <label class="form-check-label" for="is_physical">
                                                    Is physical Product?
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <h3 class="section-title">Weight Height Info</h3>
                                        </div>

                                        <div class="form-group col-6 col-md-2">
                                            <label>{{ __('Weight (cm)') }} </label>
                                            <input type="text" class="form-control" name="weight">
                                        </div>

                                        <div class="form-group col-6 col-md-2">
                                            <label>{{ __('Height (cm)') }} </label>
                                            <input type="text" class="form-control" name="height">
                                        </div>
                                        <div class="form-group col-6 col-md-2">
                                            <label>{{ __('Length (cm)') }} </label>
                                            <input type="text" class="form-control" name="length">
                                        </div>
                                        <div class="form-group col-6 col-md-6">
                                            <label>{{ __('Additional Shipping Charge') }} </label>
                                            <input type="text" class="form-control" name="length">
                                        </div>

                                        <div class="col-12">
                                            <h3 class="section-title">{{ __('Price Info And Stock') }}</h3>
                                        </div>
                                        <div class="form-group col-6 col-md-6">
                                            <label>{{ __('Selling Price') }} </label>
                                            <input type="text" class="form-control" name="selling_price">
                                        </div>
                                        <div class="form-group col-6 col-md-2">
                                            <label>{{ __('Discount') }} </label>
                                            <input type="text" class="form-control" name="discount">
                                        </div>
                                        <div class="form-group col-6 col-md-4">
                                            <label>{{ __('Discount Type') }} </label>
                                            <select name="discount_type" class="form-control select2">
                                                <option value="amount">{{ __('Amount') }}</option>
                                                <option value="percentage">{{ __('Percentage') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <h3 class="section-title">{{ __('Wholesale Price') }}</h3>
                                        </div>
                                        <div class="col-12 wholesale-container">
                                            <div class="row">
                                                <div class="form-group col-3">
                                                    <input type="text" class="form-control" name="min_qty[]"
                                                        placeholder="Min Qty">
                                                </div>
                                                <div class="form-group col-3">
                                                    <input type="text" class="form-control" name="max_qty[]"
                                                        placeholder="Max Qty">
                                                </div>
                                                <div class="form-group col-3">
                                                    <input type="text" class="form-control" name="price_per_piece[]"
                                                        placeholder="Price Per Piece">
                                                </div>
                                                <div
                                                    class="form-group col-3 d-flex justify-content-center align-items-center">
                                                    <button type="button" class="btn btn-primary btn-sm add-row"><i
                                                            class="fas fa-plus-circle"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="amount">{{ __('Amount') }}</option>
                                                <option value="percentage">{{ __('Percentage') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('Image') }} <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control-file" name="image">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="name" class="form-control" name="name">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Desgination') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="designation" class="form-control"
                                                name="designation">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Facebook') }} </label>
                                            <input type="text" class="form-control" name="facebook">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Twitter') }} </label>
                                            <input type="text" class="form-control" name="twitter">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Linkedin') }} </label>
                                            <input type="text" class="form-control" name="linkedin">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Instagram') }} </label>
                                            <input type="text" class="form-control" name="instagram">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="active">{{ __('Active') }}</option>
                                                <option value="inactive">{{ __('Inactive') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        </section>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.add-row').on('click', function() {
                var html =
                    '<div class="row mt-2"><div class="form-group col-3"><input type="text" class="form-control" name="min_qty[]" placeholder="Min Qty"></div><div class="form-group col-3"><input type="text" class="form-control" name="max_qty[]" placeholder="Max Qty"></div><div class="form-group col-3"><input type="text" class="form-control" name="price_per_piece[]" placeholder="Price Per Piece"></div><div class="form-group col-3 d-flex justify-content-center align-items-center"><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus-circle"></i></button></div></div>';
                $('.wholesale-container').append(html);
            });

            $(document).on('click', '.remove-row', function() {
                $(this).parent().parent().remove();
            });
        })
    </script>
@endpush
