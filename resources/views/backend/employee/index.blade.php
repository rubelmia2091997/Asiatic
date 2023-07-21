@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <div class="container">

        <div class="bg-light text-right">
            <a href="{{route('employee.create')}}" class="btn btn-outline-dark">{{__('addemployee')}}</a>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">{{ __('sl') }}</th>
            <th scope="col">{{ __('companyName') }}</th>
            <th scope="col">{{__('employeeName')}}</th>
            <th scope="col">{{__('emailAddress')}}</th>
            <th scope="col">{{__('phone')}}</th>
            <th scope="col">{{__('action')}}</th>
          </tr>
        </thead>
        <tbody>
            @if(!empty($datas) && $datas->count())
                @php
                    $i = ($datas->perPage() * ($datas->currentPage() - 1)) + 1;
                @endphp
                @foreach($datas as $key => $value)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $value->company->name }}</td>
                        <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->phone }}</td>
                        <td style="display: flex">
                            <a href="{{ route('employee.edit', ['employee' => $value->id]) }}" class="btn btn-success"><i class="far fa-edit"></i></a>
                            <form action="{{ route('employee.destroy', ['employee' => $value->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                            </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center">There are no data.</td>
                </tr>
            @endif
        </tbody>
    </table>

    {!! $datas->links() !!}

        </tbody>
    </table>

</div>
@endsection
