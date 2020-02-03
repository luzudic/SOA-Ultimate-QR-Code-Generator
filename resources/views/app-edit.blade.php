@extends('layouts.app')

@section('content')
    <form action="{{ route('app-update') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ @$App->id }}" />

        <div class="form-group">
            <label for="qr-input-app-name">{{ __('App Name:') }}</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="qr-input-app-name"
                   placeholder="Enter Application Name"
                   name="name" value="{{ @$App->name }}">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="qr-input-app-domain">{{ __('Domain:') }}</label>
            <input type="text" class="form-control @error('domain') is-invalid @enderror" id="qr-input-app-domain"
                   placeholder="Enter Domain" name="domain" value="{{ @$App->domain }}">
            @error('domain')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="qr-input-app-description">{{ __('Description:') }}</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="qr-input-app-description"
                      placeholder="Enter Description" rows="3" name="description">{{ @$App->description }}</textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <a href="{{ url('app/show/'.$App->id) }}" class="btn btn-primary">{{ __('Cancel') }}</a>
    </form>
@endsection
