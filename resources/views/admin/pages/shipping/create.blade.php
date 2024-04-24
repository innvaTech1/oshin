@extends('admin.master_layout')
@section('title')
<title>{{__('Shipping')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('Create Shipping')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.shipping.index') }}">{{__('Shipping')}}</a></div>
              <div class="breadcrumb-item">{{__('Create Shipping')}}</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.shipping.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('Shipping')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.shipping.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>{{__('Title')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control"  name="name">
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('Shipping Cost')}} <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"> {{currency() }}</span>
                                        <input type="text" class="form-control" name="fee" placeholder="0 For Free">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('Minimum Order')}} </label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"> {{currency() }}</span>
                                        <input type="text" class="form-control" name="minimum_order">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('Status')}} </label>
                                    <div class="input-group mb-3">
                                        <select name="status" id="" class="form-control">
                                            <option value="1">{{__('Active')}}</option>
                                            <option value="0">{{__('InActive')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('Description')}}</label>
                                    <textarea name="description" class="form-control text-area-5" id="" cols="30" rows="10"></textarea>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('Save')}}</button>
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
