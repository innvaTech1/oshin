@extends('admin.master_layout')
@section('title')
<title>{{__('Shipping')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('Edit Shipping')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.shipping.index') }}">{{__('Shipping')}}</a></div>
              <div class="breadcrumb-item">{{__('Edit Shipping')}}</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.shipping.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('Shipping')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.shipping.update',$shipping->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>{{__('Title')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control"  name="name" value="{{ $shipping->name }}">
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('Shipping Cost')}} <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"> {{currency() }}</span>
                                        <input type="text" class="form-control" name="fee" placeholder="0 For Free" value="{{ $shipping->fee }}">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('Minimum Order')}} </label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"> {{currency() }}</span>
                                        <input type="text" class="form-control" name="minimum_order" value="{{ $shipping->minimum_order }}">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('Status')}} </label>
                                    <div class="input-group mb-3">
                                        <select name="status" id="" class="form-control">
                                            <option value="1" @if ($shipping->status == 1)
                                                selected
                                            @endif>{{__('Active')}}</option>
                                            <option value="0" @if ($shipping->status == 0)
                                                selected
                                            @endif>{{__('InActive')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('Description')}}</label>
                                    <textarea name="description" class="form-control text-area-5" id="" cols="30" rows="10">{{ $shipping->description }}</textarea>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('Update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

@endsection
