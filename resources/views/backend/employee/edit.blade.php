@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">{{__('employeeForm')}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
                @endif
                <form method="post" action="{{ route('employee.update', $data->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                  <div class="card-body">
                    <div class="form-group">
                      <label for="firstname">{{__('firstname')}}</label>
                      <input type="text"  name="firstname" class="form-control" id="firstname" value="{{$data->first_name}}">
                    </div>
                    <div class="form-group">
                      <label for="lastname">{{__('lastname')}}</label>
                      <input type="text" name="lastname" class="form-control" id="lastname" value="{{$data->last_name}}">
                    </div>
                    <div class="form-group">
                        <label for="emailAddress">{{__('emailAddress')}}</label>
                        <input type="email" name="emailAddress" class="form-control" id="emailAddress" value="{{$data->email}}">
                    </div>
                    <div class="form-group">
                        <label for="phone">{{__('phone')}}</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone Number" maxlength="14" minlength="11" value="{{$data->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="" class="col-form-label">{{__("selectCompany")}}</label>
                        <select name="selectCompany" id="selectCompany" class="form-control" required>
							@foreach($companies as $company)
                            @if($data->company->id == $company->id)
                            <option value="{{$company->id}}" selected>{{$company->name}}</option>
                            @else
                            <option value="{{$company->id}}">{{$company->name}}</option>
                            @endif
							@endforeach
						</select>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{__('create')}}</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
    </section>
</div>
@endsection

