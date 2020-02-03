@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <table class="qr-datatable" class="display" style="width:100%">
            <thead>
            <tr>
                <th>S#</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Feedback as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->subject }}</td>
                    <td>{{ $value->message }}</td>
                    <td>{{ $value->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
