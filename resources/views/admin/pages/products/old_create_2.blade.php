@extends('admin.master_layout')
@section('title')
    <title>{{ __('Products') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Create Product') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Create Product') }}</div>
                </div>
            </div>

            <div class="section-body">
                <a href="{{ route('admin.product.index') }}" class="btn btn-primary"><i class="fas fa-list"></i>
                    {{ __('Products') }}</a>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.product.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('Thumbnail Image Preview') }}</label>
                                            <div>
                                                <img id="preview-img" class="admin-img"
                                                    src="{{ asset('uploads/website-images/preview.png') }}" alt="">
                                            </div>

                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Thumnail Image') }} <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control-file" name="thumb_image"
                                                onchange="previewThumnailImage(event)">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Banner Image') }} <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control-file" name="banner_image">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="name" class="form-control" name="name"
                                                value="{{ old('name') }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Slug') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="slug" class="form-control" name="slug"
                                                value="{{ old('slug') }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Category') }} <span class="text-danger">*</span></label>
                                            <select name="category_ids" class="form-control select2" id="category_ids" multiple>
                                                <option value="">{{ __('Select Category') }}</option>
                                                @foreach ($data['categories'] as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Sub Category') }}</label>
                                            <select name="sub_category" class="form-control select2" id="sub_category">
                                                <option value="">{{ __('Select Sub Category') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Child Category') }}</label>
                                            <select name="child_category" class="form-control select2" id="child_category">
                                                <option value="">{{ __('Select Child Category') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Brand') }} <span class="text-danger">*</span></label>
                                            <select name="brand" class="form-control select2" id="brand">
                                                <option value="">{{ __('Select Brand') }}</option>
                                                @foreach ($data['brands'] as $brand)
                                                    <option {{ old('brand') == $brand->id ? 'selected' : '' }}
                                                        value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('SKU') }} </label>
                                            <input type="text" class="form-control" name="sku">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Price') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="price"
                                                value="{{ old('price') }}">
                                        </div>

                                        <div class="form-group col-6">
                                            <label>{{ __('Discount') }}</label>
                                            <input type="text" class="form-control" name="discount"
                                                value="{{ old('discount') }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>{{ __('Discount Type') }}</label>
                                            <select name="discount_type" id="" class="form-control">
                                                <option value="fixed">{{ __('Fixed') }}</option>
                                                <option value="percent">{{ __('Percent') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Stock Quantity') }} <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="quantity"
                                                value="{{ old('quantity') }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Video Link') }}</label>
                                            <input type="text" class="form-control" name="video_link"
                                                value="{{ old('video_link') }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Short Description') }} <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="short_description" id="" cols="30" rows="10" class="form-control text-area-5">{{ old('short_description') }}</textarea>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Long Description') }} <span class="text-danger">*</span></label>
                                            <textarea name="long_description" id="" cols="30" rows="10" class="summernote">{{ old('long_description') }}</textarea>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Tags') }}</label>
                                            <input type="text" class="form-control tags" name="tags"
                                                value="{{ old('tags') }}">
                                        </div>

                                        {{-- <div class="form-group col-12">
                                    <label>{{__('Tax')}} <span class="text-danger">*</span></label>
                                    <select name="tax" class="form-control">
                                        <option value="">{{__('Select Tax')}}</option>
                                        @foreach ($productTaxs as $tax)
                                            <option {{ old('tax') == $tax->id ? 'selected' : '' }}  value="{{ $tax->id }}">{{ $tax->title }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                        <div class="form-group col-12">
                                            <label>{{ __('Product Return Available?') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="is_return" class="form-control" id="is_return">
                                                <option value="0">{{ __('No') }}</option>
                                                <option value="1">{{ __('Yes') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Is Wholesale') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="is_wholesale" class="form-control" id="is_wholesale">
                                                <option value="0">{{ __('No') }}</option>
                                                <option value="1">{{ __('Yes') }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Is Preorder') }} </label>
                                            <select name="is_pre_order" class="form-control" id="is_pre_order">
                                                <option value="0">{{ __('No') }}</option>
                                                <option value="1">{{ __('Yes') }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Preorder Date') }} </label>
                                            <input type="date" class="form-control" name="pre_order_date"
                                                value="{{ old('pre_order_date') }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Has Partisal Payment?') }} </label>
                                            <select name="partial_payment" class="form-control" id="partial_payment">
                                                <option value="0">{{ __('No') }}</option>
                                                <option value="1">{{ __('Yes') }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Partial Payment Amount') }} </label>
                                            <input type="number" class="form-control" name="partial_payment_amount"
                                                value="{{ old('partial_payment_amount') }}">
                                        </div>

                                        <div class="form-group col-12 d-none" id="policy_box">
                                            <label>{{ __('Return Policy') }} <span class="text-danger">*</span></label>
                                            {{-- <select name="return_policy_id" class="form-control">
                                        @foreach ($retrunPolicies as $retrunPolicy)
                                            <option value="{{ $retrunPolicy->id }}">{{ $retrunPolicy->title }}</option>
                                        @endforeach
                                    </select> --}}
                                        </div>


                                        <div class="form-group col-12">
                                            <label>{{ __('Warranty Available ?') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="is_warranty" class="form-control">
                                                <option value="1">{{ __('Yes') }}</option>
                                                <option value="0">{{ __('No') }}</option>
                                            </select>
                                        </div>



                                        <div class="form-group col-12">
                                            <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="1">{{ __('Active') }}</option>
                                                <option value="0">{{ __('Inactive') }}</option>
                                            </select>
                                        </div>



                                        <div class="form-group col-12">
                                            <label>{{ __('SEO Title') }}</label>
                                            <input type="text" class="form-control" name="seo_title"
                                                value="{{ old('seo_title') }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('SEO Description') }}</label>
                                            <textarea name="seo_description" id="" cols="30" rows="10" class="form-control text-area-5">{{ old('seo_description') }}</textarea>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Specifications') }}</label>
                                            <div>
                                                <a href="javascript::void()" id="manageSpecificationBox">
                                                    <input name="is_specification" id="status_toggle" type="checkbox"
                                                        checked data-toggle="toggle" data-on="Enable" data-off="Disabled"
                                                        data-onstyle="success" data-offstyle="danger">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group col-12" id="specification-box">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>{{ __('Key') }} <span class="text-danger">*</span></label>
                                                    {{-- <select name="keys[]" class="form-control">
                                                @foreach ($specificationKeys as $specificationKey)
                                                    <option value="{{ $specificationKey->id }}">{{ $specificationKey->key }}</option>
                                                @endforeach
                                            </select> --}}
                                                </div>
                                                <div class="col-md-5">
                                                    <label>{{ __('Specification') }} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="specifications[]">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-success plus_btn"
                                                        id="addNewSpecificationRow"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>


                                        <div id="hidden-specification-box" class="d-none">
                                            <div class="delete-specification-row">
                                                <div class="row mt-2">
                                                    <div class="col-md-5">
                                                        <label>{{ __('Key') }} <span
                                                                class="text-danger">*</span></label>
                                                        {{-- <select name="keys[]" class="form-control">
                                                    @foreach ($specificationKeys as $specificationKey)
                                                        <option value="{{ $specificationKey->id }}">{{ $specificationKey->key }}</option>
                                                    @endforeach
                                                </select> --}}
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label>{{ __('Specification') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="specifications[]">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button"
                                                            class="btn btn-danger plus_btn deleteSpeceficationBtn"><i
                                                                class="fas fa-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <script>
        (function($) {
            "use strict";
            var specification = true;
            $(document).ready(function() {
                $("#name").on("focusout", function(e) {
                    $("#slug").val(convertToSlug($(this).val()));
                })

                $("#category").on("change", function() {
                    var categoryId = $("#category").val();
                    if (categoryId) {
                        $.ajax({
                            type: "get",
                            url: "{{ route('admin.get.sub-category', '') }}" + "/" +
                                categoryId,
                            success: function(response) {
                                console.log(response);
                                $("#sub_category").html(response.subCategories);
                                var response =
                                    "<option value=''>{{ __('Select Child Category') }}</option>";
                                $("#child_category").html(response);
                            },
                            error: function(err) {
                                console.log(err);

                            }
                        })
                    } else {
                        var response =
                            "<option value=''>{{ __('Select Sub Category') }}</option>";
                        $("#sub_category").html(response);
                        var response =
                            "<option value=''>{{ __('Select Child Category') }}</option>";
                        $("#child_category").html(response);
                    }


                })

                $("#sub_category").on("change", function() {
                    var SubCategoryId = $("#sub_category").val();
                    if (SubCategoryId) {
                        $.ajax({
                            type: "get",
                            url: "{{ url('/admin/childcategory-by-subcategory/') }}" + "/" +
                                SubCategoryId,
                            success: function(response) {
                                $("#child_category").html(response.childCategories);
                            },
                            error: function(err) {
                                console.log(err);

                            }
                        })
                    } else {
                        var response =
                            "<option value=''>{{ __('Select Child Category') }}</option>";
                        $("#child_category").html(response);
                    }

                })

                $("#is_return").on('change', function() {
                    var returnId = $("#is_return").val();
                    if (returnId == 1) {
                        $("#policy_box").removeClass('d-none');
                    } else {
                        $("#policy_box").addClass('d-none');
                    }

                })

                $("#addNewSpecificationRow").on('click', function() {
                    var html = $("#hidden-specification-box").html();
                    $("#specification-box").append(html);
                })

                $(document).on('click', '.deleteSpeceficationBtn', function() {
                    $(this).closest('.delete-specification-row').remove();
                });


                $("#manageSpecificationBox").on("click", function() {
                    if (specification) {
                        specification = false;
                        $("#specification-box").addClass('d-none');
                    } else {
                        specification = true;
                        $("#specification-box").removeClass('d-none');
                    }


                })

            });
        })(jQuery);

        function convertToSlug(Text) {
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        }

        function previewThumnailImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview-img');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
@endsection
