@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <table class="qr-datatable" class="display" style="width:100%">
            <thead>
            <tr>
                <th>S#</th>
                <th>IP</th>
                <th>City</th>
                <th>Region</th>
                <th>Country</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Postal</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Visitors as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ @$value->ip }}</td>
                    <td>{{ @$value->city }}</td>
                    <td>{{ @$value->region }}</td>
                    <td>{{ @$value->country }}</td>
                    <td>{{ @$value->loc[0] }}</td>
                    <td>{{ @$value->loc[1] }}</td>
                    <td>{{ @$value->postal }}</td>
                    <td>{{ @$value->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
