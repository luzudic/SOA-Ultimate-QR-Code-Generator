@extends('layouts.app')

@section('content')

    <div class="table-responsive">
        <table class="qr-datatable" class="display" style="width:100%">
            <thead>
            <tr>
                <th scope="col">S.No.</th>
                <th scope="col">Name</th>
                <th scope="col">URL</th>
                <th scope="col">Visits</th>
                <th scope="col">Created At</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($App->codes()->orderBy('id','desc')->get() as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->url }}</td>
                    <td><a href="{{ url('/app/code/visitor?code_id='.$value->id) }}">{{ $value->visits }}</a></td>
                    <td>{{ $value->created_at }}</td>
                    <td><a href="{{ url('app/code/show/'.$value->id) }}"><i class="fa fa-eye"></i></a> <a href="{{ url('app/code/edit/'.$value->id) }}"><i class="fa fa-edit"></i></a> <a href="{{ $value->code }}" download ><i class="fa fa-download"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
