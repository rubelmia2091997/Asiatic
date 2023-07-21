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
                <form method="post" action="{{ route('employee.store') }}" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="firstname">{{__('firstname')}}</label>
                      <input type="text"  name="firstname" class="form-control" id="firstname" placeholder="Enter first name" required>
                    </div>
                    <div class="form-group">
                      <label for="lastname">{{__('lastname')}}</label>
                      <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter last name" required>
                    </div>
                    <div class="form-group">
                        <label for="emailAddress">{{__('emailAddress')}}</label>
                        <input type="email" name="emailAddress" class="form-control" id="emailAddress" placeholder="Enter email address">
                    </div>
                    <div class="form-group">
                        <label for="phone">{{__('phone')}}</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone Number" maxlength="14" minlength="11">
                    </div>
                    <div class="form-group">
                        <label for="" class="col-form-label">{{__("selectCompany")}}</label>
                        <select name="selectCompany" id="selectCompany" class="form-control" required>
                            <option value="" selected>{{__("selectCompany")}}</option>
							@foreach($companies as $company)
								<option value="{{$company->id}}">{{$company->name}}</option>
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
