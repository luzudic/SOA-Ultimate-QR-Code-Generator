@extends('layouts.app')

@section('content')

    <div class="form-group">
        <a href="{{ route('app-create') }}" type="button" class="btn btn-primary">{{ __('Create App') }}</a>
    </div>


    <div class="table-responsive">
        <table class="qr-datatable" class="display" style="width:100%">
            <thead>
            <tr>
                <th scope="col">S.No.</th>
                <th scope="col">Name</th>
                <th scope="col">Domain</th>
                <th scope="col">App Key</th>
                <th scope="col">Total Codes</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Apps as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->domain }}</td>
                    <td>{{ $value->app_key }}</td>
                    <td><a href="{{ url('app/code?id='.$value->id) }}">{{ @$value->codes->count() }}</a></td>
                    <td><a href="{{ url('app/show/'.$value->id) }}"><i class="fa fa-eye"></i></a> <a href="{{ url('app/edit/'.$value->id) }}"><i class="fa fa-edit"></i></a> <a href="{{ url('app/delete/'.$value->id) }}"><i class="fa fa-trash"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
