@extends('admin.master_layout')

@section('title')
    <title>{{ __('Attribute List') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Attribute List') }}</h1>
            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.attribute.store') }}" method="POST"
                                    enctype="multipart/form-data" id="form">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="name" class="form-control" name="name">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Description') }}</label>
                                            <textarea name="description" id="description" cols="30" rows="10" class="form-control" style="height:50px"></textarea>
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
                                        <div class="form-group col-12 row">
                                            <div class="d-flex justify-content-between w-100 mb-3">
                                                <label class="inline-block">{{ __('Attribute') }} <span
                                                        class="text-danger">*</span></label>
                                                <button type="button"
                                                    class="btn btn-primary btn-sm add-variant">Add</button>
                                            </div>
                                            <div class="col-12">
                                                <table class="variant-table">
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="variant_values[]"
                                                                class="form-control">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
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
                                                <th>{{ __('Description') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($attributes as $index => $attribute)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $attribute->name }}</td>
                                                    <td>{{ $attribute?->description }}</td>
                                                    <td>
                                                        @if ($attribute->status == 1)
                                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.attribute.edit', $attribute->id) }}"
                                                            class="btn btn-primary btn-sm edit-btn"><i class="fa fa-edit"
                                                                aria-hidden="true"></i></a>
                                                        <a href="javascript:;" data-toggle="modal"
                                                            data-target="#deleteModal" class="btn btn-danger btn-sm"
                                                            onclick="deleteData({{ $attribute->id }})"><i
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

    @include('components.admin.preloader')
@endsection

@push('js')
    <script>
        $(document).ready(function() {

            $("[name='attribute']").change(function() {
                if ($(this).is(':checked')) {
                    $('.parent').removeClass('d-none');
                } else {
                    $('.parent').addClass('d-none');
                }
            });
            $('.edit-btn').click(function(e) {

                $('.preloader_area').removeClass('d-none');
                e.preventDefault();
                const url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('#name').val(response.name);
                        $('#description').val(response.description);

                        console.log(response)
                        if (response.status == 1) {
                            $("[name='status'][value='1']").prop('checked', true);
                        } else {
                            $("[name='status'][value='0']").prop('checked', true);
                        }

                        $('.variant-table').html('');

                        response.values.forEach(function(variant) {
                            $('.variant-table').append(
                                '<tr><td><input type="text" name="variant_values[]" class="form-control" value="' +
                                variant.value +
                                '"></td><td><button class="bariant-trash btn btn-danger"><i class="fas fa-trash"></i></button></td></tr>'
                            );
                        });


                        let url = "{{ route('admin.attribute.update', ':id') }}";
                        url = url.replace(':id', response.id);
                        console.log(url);
                        $('#form').attr('action', url);
                        const attributeId = "<input type='hidden' name='attribute_id' value='" +
                            response.id + "'>";
                        const method = "<input type='hidden' name='_method' value='PUT'>";
                        $('#form').append(attributeId);
                        $('#form').append(method);
                        $('.preloader_area').addClass('d-none');
                    },
                    error: function(error) {
                        console.log(error);
                        $('.preloader_area').addClass('d-none');
                    }
                });
            })
            $('.add-variant').click(function() {
                $('.variant-table').append(
                    '<tr><td><input type="text" name="variant_values[]" class="form-control"></td><td><button class="bariant-trash btn btn-danger"><i class="fas fa-trash"></i></button></td></tr>'
                );
            });
            $(document).on('click', '.bariant-trash', function() {
                $(this).closest('tr').remove();
            });
        });

        function deleteData(id) {
            let url = '{{ route('admin.attribute.destroy', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
    </script>
@endpush
