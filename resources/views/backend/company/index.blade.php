@extends('backend.master')
@section('addcss')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/moment-2.18.1/jszip-2.5.0/pdfmake-0.1.36/dt-1.10.20/af-2.3.4/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/rr-1.2.6/sc-2.0.1/sp-1.0.1/sl-1.3.1/datatables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.9.0/css/selectize.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/rg-1.1.4/datatables.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/sc-2.0.5/datatables.min.css"/>
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="bg-light text-right">
                    <a href="{{route('company.create')}}" class="btn btn-outline-light">{{__('addCompany')}}</a>
                </div>
                <table id="myTable" class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">{{ __('sl') }}</th>
                        <th scope="col">{{ __('companyLogo') }}</th>
                        <th scope="col">{{ __('companyName') }}</th>
                        <th scope="col">{{ __('companyEmail') }}</th>
                        <th scope="col">{{__('action')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                            @foreach($datas as $key => $value)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        @if (is_null($value->logo))
                                        N/A
                                        @else
                                        <img src="{{asset('/storage/companyLogo/'.$value->logo)}}" alt="{{$value->name}}" width="50" height="50">
                                        @endif
                                    </td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td style="display: flex">
                                        <span>

                                            <a href="{{ route('company.edit', ['company' => $value->id]) }}" class="btn btn-success"><i class="far fa-edit"></i></a>
                                        </span>
                                        <span>

                                            <form action="{{ route('company.destroy', ['company' => $value->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </form>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
    </section>
</div>
@endsection
@section('script.js')
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/v/dt/jq-3.3.1/moment-2.18.1/jszip-2.5.0/pdfmake-0.1.36/dt-1.10.20/af-2.3.4/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/rr-1.2.6/sc-2.0.1/sp-1.0.1/sl-1.3.1/datatables.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script> -->
        <script   type="text/javascript" charset="utf-8"  src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/datetime-moment.js"></script>
        <script  type="text/javascript" charset="utf-8"  src="https://cdn.datatables.net/plug-ins/1.10.19/dataRender/datetime.js"></script>
        <script type="text/javascript" charset="utf-8"src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.9.0/js/standalone/selectize.js"></script>


        <script>
            $(document).ready( function () {
            $('#myTable').DataTable({
                info: true,
                ordering: true,
                "paging": true,
                dom: 'Blfrtip',
                buttons: [
                    { extend: 'print', exportOptions:

                        { columns: [ 0, 2 ,3 ] }
                    },
                    { extend: 'copy', exportOptions:
                    { columns: [ 0, 2 ,3 ] }
                    },
                    { extend: 'excel', exportOptions:
                    { columns: [ 0, 2 ,3 ] }
                    },
                    { extend: 'pdf', exportOptions:
                    { columns: [ 0, 2 ,3 ] }
                    },
                    { extend: 'colvis',   postfixButtons: [ 'colvisRestore' ] }
                ]
            });
        } );
        </script>
@endsection
