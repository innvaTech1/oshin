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
                                        <div class="col-12 row attributes_variatiions">
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

    <!-- Modal for adding wholesale prices -->
    {{-- <div class="modal fade" id="add-price-wholesale" tabindex="-1" role="dialog"
        aria-labelledby="addPriceWholesaleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPriceWholesaleModalLabel">Add Wholesale Price</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="wholesalePriceForm">
                        <div id="wholesalePriceFields">
                            <input type="hidden" name="variation_wholesale_name[]">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="wholesalePrice">Wholesale Price</label>
                                    <input type="text" class="form-control" name="variation_wholesale_price[]"
                                        placeholder="Enter Wholesale Price">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="minQuantity">Minimum Quantity</label>
                                    <input type="number" class="form-control" name="variation_min_quantity[]"
                                        placeholder="Enter Minimum Quantity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="maxQuantity">Maximum Quantity</label>
                                    <input type="number" class="form-control" name="variation_max_quantity[]"
                                        placeholder="Enter Maximum Quantity">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="addFields">Add Price Field</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveWholesalePrice">Save</button>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- wholesale modal container --}}

    <div class="wholesale-modal-container"></div>


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
                                <select name="choice_options_${attribute.id}[]" class="form-control select2 attr-multi-value" multiple>
                        `;

                            $.each(attribute.values, function(index, value) {
                                html +=
                                    `<option value="${value.value}">${value.value}</option>`;
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

            $(document).on('change', '.attr-multi-value', function() {
                // Initialize an empty array to store selected values
                var selectedValues = [];

                // Loop through each select element
                $('.attr-multi-value').each(function(index, select) {
                    // Get the selected options for the current select element
                    var selectedOptions = $(select).val();

                    // If options are selected, add them to the selectedValues array
                    if (selectedOptions && selectedOptions.length > 0) {
                        selectedValues.push(selectedOptions);
                    }
                });

                // Create a variation table HTML
                var variationTableHTML =
                    '<table class="table"><thead><tr><th>Variant</th><th>Selling Price</th><th>SKU</th></tr></thead><tbody>';
                let modal = '';
                // Generate rows for each combination of selected values
                selectedValues = cartesian(selectedValues);
                $.each(selectedValues, function(index, combination) {
                    // Create a row for the combination
                    variationTableHTML += '<tr>';
                    variationTableHTML += '<td>' + combination.join('-') +
                        `<input type="hidden" name="variant[]" value="${combination.join('-')}">` +
                        '</td>'; // Variant column (joined if there are multiple)
                    variationTableHTML +=
                        `<td class="d-flex justify-content-between align-items-center"><input type="text" class="form-control selling-price" name="selling_price[]" placeholder="Enter Selling Price"> <button type="button" class="btn btn-primary ml-2" title="" data-toggle="modal" data-target="#add-price-wholesale-${combination.join('-')}"><i class="fas fa-plus"></i></button>
                            <ul class="price-wholesale-list"></ul>
                            </td>
                        
                        `; // Selling Price column with input
                    variationTableHTML +=
                        `<td><input type="text" class="form-control sku" name="sku[]" placeholder="Enter SKU" value="${combination.join('-')}"></td>`; // SKU column with input
                    variationTableHTML += '</tr>';
                });

                variationTableHTML += '</tbody></table>';

                // Append the variation table HTML to a container
                $('.attributes_variatiions').html(variationTableHTML);
                $('.wholesale-modal-container').html(modal)

            });
        })

        function cartesian(arrays) {
            var result = [];
            var max = arrays.length - 1;

            function helper(arr, i) {
                for (var j = 0, l = arrays[i].length; j < l; j++) {
                    var a = arr.slice(0); // clone arr
                    a.push(arrays[i][j]);
                    if (i == max)
                        result.push(a);
                    else
                        helper(a, i + 1);
                }
            }
            helper([], 0);
            return result;
        }
    </script>

    <script>
        $(document).ready(function() {
            // Add Price Field button click event
            $('.addFields').click(function() {
                const variant = $(this).data('variant');
                var fieldHTML = `
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="variation_wholesale_price[]" placeholder="Enter Wholesale Price">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="variation_min_quantity[]" placeholder="Enter Minimum Quantity">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="variation_max_quantity[]" placeholder="Enter Maximum Quantity">
                        </div>
                        <div class="form-group col-md-2 d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-danger removeField"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>`;

                $(`#wholesalePriceFields-${variant}`).append(fieldHTML);
            });

            $(document).on('click', '.removeField', function() {
                $(this).closest('.form-row').remove();
            });

            // Save Wholesale Price button click event
            $('#saveWholesalePrice').click(function() {
                // Perform save action here
            });
        });
    </script>

@endpush


{{-- Media Css --}}
@push('css')
    @if (Module::isEnabled('Media'))
        @stack('media_libary_css')
    @endif
@endpush
