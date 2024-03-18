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
                                            <h3 class="section-title">{{ __('Product Information') }}</h3>
                                        </div>
                                        <div class="form-group col-12">
                                            <label class="d-block">{{ __('Type') }}</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="Single" value="single"
                                                    name="product_type" checked>
                                                <label class="form-check-label" for="Single">{{ __('Single') }}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="Variant"
                                                    value="variant" name="product_type">
                                                <label class="form-check-label" for="Variant">{{ __('Variant') }}</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>{{ __('Product Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="product_name" class="form-control"
                                                name="product_name">
                                        </div>

                                        <div class="form-group col-6 product-single">
                                            <label>{{ __('Product SKU') }}</label>
                                            <input type="text" id="productSku" class="form-control" name="product_sku">
                                        </div>
                                        <div class="form-group col-4 for-variant d-none">
                                            <label>{{ __('Variant SKU Prefix') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="variant_sku_prefix" class="form-control"
                                                name="variant_sku_prefix">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>{{ __('Model Number') }}</label>
                                            <input type="text" id="model_number" class="form-control"
                                                name="model_number">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>{{ __('Category') }} <span class="text-danger">*</span></label>
                                            <select name="category_ids[]" id="" class="form-control select2"
                                                multiple>
                                                <option value="" disabled>{{ __('Select') }}</option>
                                                @foreach ($data['categories'] as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>{{ __('Brand') }} </label>
                                            <select name="brand_id" id="" class="form-control select2">
                                                <option value="" disabled selected>{{ __('Select') }}</option>
                                                @foreach ($data['brands'] as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>{{ __('Unit') }} <span class="text-danger">*</span></label>
                                            <select name="unit_id" id="" class="form-control select2">
                                                <option value="" disabled selected>{{ __('Select') }}</option>
                                                @foreach ($data['units'] as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>{{ __('Minimum Order Qty') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="minimum_order_qty">
                                        </div>
                                        <div class="form-group col-3">
                                            <label>{{ __('Maximum Order Qty') }}</label>
                                            <input type="text" class="form-control" name="max_order_qty">
                                        </div>

                                        <div class="form-group col-9">
                                            <label>{{ __('Tags') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control inputtags" name="tags">
                                        </div>
                                        <div class="form-group col-12 for-variant d-none">
                                            <label>{{ __('Attribute') }} </label>
                                            <select name="attribute_id[]" id="attribute_id" class="form-control select2"
                                                multiple>
                                                <option value="" disabled>{{ __('Select') }}</option>
                                                @foreach ($data['attributes'] as $attribute)
                                                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 row attributes_values">
                                        </div>
                                        <div class="form-group col-12">
                                            <label class="custom-switch mt-2" style="padding-left: 0px !important;">
                                                <input type="checkbox" name="is_physical" id="is_physical"
                                                    value="1" checked class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                                <span
                                                    class="custom-switch-description">{{ __('Is physical Product?') }}</span>
                                            </label>
                                        </div>

                                        <div class="form-group col-6 col-md-12 d-none single_digital_file">
                                            <label>{{ __('Program File') }} </label>
                                            <input type="file" class="form-control" name="single_digital_file">
                                        </div>

                                        <div class="col-12 row physical_product">
                                            <div class="col-12">
                                                <h3 class="section-title">{{ __('Weight Height Info') }}</h3>
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

                                        </div>
                                        <div class="col-12">
                                            <h3 class="section-title">{{ __('Price Info And Stock') }}</h3>
                                        </div>
                                        <div class="form-group col-6 col-md-6 product-single">
                                            <label>{{ __('Selling Price') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="selling_price">
                                        </div>
                                        <div class="form-group col-6 col-md-2">
                                            <label>{{ __('Discount') }} <span class="text-danger">*</span></label>
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

                                        <div class="form-group col-12">
                                            <label class="custom-switch mt-2" style="padding-left: 0px !important;">
                                                <input type="checkbox" name="is_wholesale" id="is_wholesale"
                                                    value="1" class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                                <span
                                                    class="custom-switch-description">{{ __('Allow Wholesale?') }}</span>
                                            </label>
                                        </div>
                                        <div class="col-12 wholesale-container d-none">
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
                                            <label>{{ __('Description') }} <span class="text-danger">*</span></label>
                                            <textarea name="description" id="" cols="30" rows="10" class="summernote">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Specification') }} <span class="text-danger">*</span></label>
                                            <textarea name="specification" id="" cols="30" rows="10" class="summernote">{{ old('specification') }}</textarea>
                                            @error('specification')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <h3 class="section-title">{{ __('Seo Information') }}</h3>
                                        </div>

                                        <div class="form-group col-6 col-md-12">
                                            <label>{{ __('Meta Title') }} </label>
                                            <input type="text" class="form-control" name="meta_title"
                                                value="{{ old('meta_title') }}">
                                        </div>

                                        <div class="form-group col-6 col-md-12">
                                            <label>{{ __('Meta Description') }} </label>
                                            <textarea name="meta_description" id="" cols="30" rows="10" class="form-control"
                                                style="height: 85px;">{{ old('meta_description') }}</textarea>
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
                                        <div class="col-12">
                                            <h3 class="section-title">{{ __('Product Image') }}</h3>
                                        </div>

                                        {{-- Media File input --}}
                                        @if (Module::isEnabled('Media'))
                                            <div class="form-group col-md-12">
                                                <x-media::media-input name="image[]" multiple="yes" classes="col-12 "
                                                    label_text="Product Image" />
                                            </div>
                                        @endif
                                        <div class="col-12">
                                            <h3 class="section-title">{{ __('Other Info') }}</h3>
                                        </div>

                                        <div class="form-group col-12">
                                            <label class="custom-switch mt-2" style="padding-left: 0px !important;">
                                                <input type="checkbox" name="is_partial_amount" id="is_partial_amount"
                                                    value="1" class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                                <span
                                                    class="custom-switch-description">{{ __('Allow Partial Amount?') }}</span>
                                            </label>
                                        </div>
                                        <div class="form-group col-12 partial_amount d-none">
                                            <label>{{ __('Partial Amount') }} </label>
                                            <input type="number" id="partial_amount" class="form-control"
                                                name="partial_amount">
                                        </div>

                                        <div class="form-group col-12">
                                            <label class="custom-switch mt-2" style="padding-left: 0px !important;">
                                                <input type="checkbox" name="status" id="status" value="1"
                                                    class="custom-switch-input" checked>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">{{ __('Status') }}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        </section>

        @include('components.admin.preloader')
    </div>

    {{-- Media Modal Show --}}
    @if (Module::isEnabled('Media'))
        @stack('media_list_html')
    @endif
@endsection

@push('js')
    {{-- Media Js --}}
    @if (Module::isEnabled('Media'))
        @stack('media_libary_js')
    @endif
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

            $('[name="product_type"]').on('change', function() {
                if ($(this).val() == 'single') {
                    $('.product-single').removeClass('d-none');
                    $('.for-variant').addClass('d-none')

                    // disabled all input select tag inside for variant class
                    $('.for-variant input, .for-variant select').prop('disabled', true);

                    // enable all input select tag inside .product-single class
                    $('.product-single input, .product-single select').prop('disabled', false);
                } else {
                    $('.product-single').addClass('d-none');
                    $('.for-variant').removeClass('d-none');
                    $('.for-variant input, .for-variant select').prop('disabled', false);

                    // disable all input select tag inside .product-single class
                    $('.product-single input, .product-single select').prop('disabled', true);
                }
            });

            $('[name="is_physical"]').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.single_digital_file').addClass('d-none');
                    $('.physical_product').removeClass('d-none');
                } else {
                    $('.single_digital_file').removeClass('d-none');
                    $('.physical_product').addClass('d-none');
                }
            });

            $('[name="is_wholesale"]').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.wholesale-container').removeClass('d-none');
                } else {
                    $('.wholesale-container').addClass('d-none');
                }
            });
            $('#is_partial_amount').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.partial_amount').removeClass('d-none');
                } else {
                    $('.partial_amount').addClass('d-none');
                }
            });

            $('#attribute_id').on('change', function() {
                var attribute_id = $(this).val();
                $('.preloader_area').removeClass('d-none')
                // get attributes values
                $.ajax({
                    url: "{{ route('admin.attribute.values') }}",
                    type: "POST",
                    data: {
                        attribute_id: attribute_id
                    },
                    success: function(response) {
                        $('.attributes_values').html('');
                        $.each(response, function(index, attribute) {
                            let html = `
                            <div class="col-4 mb-2">
                                <input type="text" name='choice[]' value="${attribute.name}" class="form-control" readonly>
                            </div>
                            <div class="col-8 mb-2">
                                <select name="choice_options_${attribute.id}[]" class="form-control select2" multiple>
                        `;

                            $.each(attribute.values, function(index, value) {
                                html +=
                                    `<option value="${value.id}">${value.value}</option>`;
                            });

                            html += `
                                </select>
                            </div>
                        `;

                            // Append the generated HTML to a container
                            $('.attributes_values').append(html);
                        });

                        // After appending all select elements, initialize Select2
                        $('.select2').select2();


                        $('.preloader_area').addClass('d-none')
                    }
                })

            })
        })
    </script>

@endpush


{{-- Media Css --}}
@push('css')
    @if (Module::isEnabled('Media'))
        @stack('media_libary_css')
    @endif
@endpush
