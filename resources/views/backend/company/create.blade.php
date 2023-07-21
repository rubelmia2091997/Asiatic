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
                  <h3 class="card-title">{{__('companyForm')}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach 
                @endif
                <form method="post" action="{{ route('company.store') }}" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="companyName">{{__('companyName')}}</label>
                      <input type="text"  name="companyName" class="form-control" id="companyName" placeholder="Enter Company Name" >
                    </div>
                    <div class="form-group">
                        <label for="companyEmail">{{__('companyEmail')}}</label>
                        <input type="email" name="companyEmail" class="form-control" id="companyEmail" placeholder="Enter Company Email">
                    </div>
                    <div class="form-group">
                        <label for="companyLogo">{{__('companyLogo')}} {{__('dimension')}} </label>
                        <input type="file" name="companyLogo" class="form-control" id="companyLogo" >
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
