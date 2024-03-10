@extends('admin.master_layout')

@section('title')
    <title>{{ __('Category List') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Category List') }}</h1>
            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.category.store') }}" method="POST"
                                    enctype="multipart/form-data" id="form">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="name" class="form-control" name="name">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Slug') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="slug" class="form-control" name="slug">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Commission Rate') }}</label>
                                            <input type="text" id="commission_rate" class="form-control"
                                                name="commission_rate">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Searchable') }} </label>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <input type="radio" name='searchable' value="1" checked />
                                                    <label>{{ __('Active') }} </label>
                                                </div>
                                                <div>
                                                    <input type="radio" name='searchable' value="0" />
                                                    <label>{{ __('Inactive') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Status') }} </label>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <input type="radio" name='status' value="1" checked />
                                                    <label>{{ __('Active') }} </label>
                                                </div>
                                                <div>
                                                    <input type="radio" name='status' value="0" />
                                                    <label>{{ __('Inactive') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <div>
                                                <input type="checkbox" name='category' value="1" />
                                                <label>{{ __('Add as Sub Category') }} </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-12 d-none parent">
                                            <label>{{ __('Parent Category') }} <span class="text-danger">*</span></label>
                                            <select name="parent_id" class="form-control select2">
                                                <option value="" selected disabled>{{ __('Select One') }}</option>

                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ __($category->name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Image') }}</label>
                                            <input type="file" class="form-control-file" name="image">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <x-admin.save-button :text="__('Save')" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Parent Category') }}</th>
                                                <th>{{ __('Commission') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $index => $category)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category?->parent_category?->name }}</td>
                                                    <td>
                                                        @if ($category->status == 1)
                                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.category.edit', $category->id) }}"
                                                            class="btn btn-primary btn-sm edit-btn"><i class="fa fa-edit"
                                                                aria-hidden="true"></i></a>
                                                        <a href="javascript:;" data-toggle="modal"
                                                            data-target="#deleteModal" class="btn btn-danger btn-sm"
                                                            onclick="deleteData({{ $category->id }})"><i
                                                                class="fa fa-trash" aria-hidden="true"></i></a>
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

@push('js')
    <script>
        $(document).ready(function() {
            $("#name").keyup(function() {
                makeSlug("#name", '#slug');
            });
            $("[name='category']").change(function() {
                if ($(this).is(':checked')) {
                    $('.parent').removeClass('d-none');
                } else {
                    $('.parent').addClass('d-none');
                }
            });
            $('.edit-btn').click(function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('#name').val(response.name);
                        $('#slug').val(response.slug);
                        $('#commission_rate').val(response.commission_rate);
                        if (response.searchable == 1) {
                            $("[name='searchable'][value='1']").prop('checked', true);
                        } else {
                            $("[name='searchable'][value='0']").prop('checked', true);
                        }
                        if (response.status == 1) {
                            $("[name='status'][value='1']").prop('checked', true);
                        } else {
                            $("[name='status'][value='0']").prop('checked', true);
                        }
                        if (response.parent_id) {
                            $("[name='category']").prop('checked', true);
                            $('.parent').removeClass('d-none');
                            $('.select2').val(response.parent_id).trigger('change');
                        }
                        let url = "{{ route('admin.category.update', ':id') }}";
                        url = url.replace(':id', response.id);
                        console.log(url);
                        $('#form').attr('action', url);
                        const categoryId = "<input type='hidden' name='category_id' value='" +
                            response.id + "'>";
                        const method = "<input type='hidden' name='_method' value='PUT'>";
                        $('#form').append(categoryId);
                        $('#form').append(method);
                    }
                });
            })
        });

        function deleteData(id) {
            let url = '{{ route('admin.category.destroy', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
    </script>
@endpush
