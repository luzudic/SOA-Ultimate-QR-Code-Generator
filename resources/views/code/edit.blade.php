@extends('layouts.app')

@section('content')
    <form action="{{ route('app-code-update') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ @$Code->id }}" />

        <div class="form-group">
            <label for="name">{{ __('Name:') }}</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                   placeholder="Enter Name"
                   name="name" value="{{ @$Code->name }}">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="url">{{ __('URL:') }}</label>
            <input type="text" class="form-control @error('url') is-invalid @enderror" id="url"
                   placeholder="Enter URL" name="url" value="{{ @$Code->url }}">
            @error('url')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <a href="" class="btn btn-primary">{{ __('Cancel') }}</a>
    </form>
@endsection
