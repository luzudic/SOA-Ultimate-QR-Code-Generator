@extends('layouts.app')

@section('content')
    <div class="form-group">
        <label for="qr-input-app-name">{{ __('App Name:') }}</label>
        <input type="text" class="form-control" id="qr-input-app-name" value="{{ @$App->name }}" disabled>
    </div>
    <div class="form-group">
        <label for="qr-input-app-domain">{{ __('Domain:') }}</label>
        <input type="text" class="form-control" id="qr-input-app-domain" value="{{ @$App->domain }}" disabled>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">{{ __('Description:') }}</label>
        <textarea class="form-control" id="qr-input-app-description" rows="3"
                  disabled>{{ @$App->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="qr-input-app-name">{{ __('App Key:') }}</label>
        <input type="text" class="form-control" id="qr-input-app-id" value="{{ @$App->app_key}}" disabled>
    </div>
    <div class="form-group">
        <label for="qr-input-app-domain">{{ __('Secret Key:') }}</label>
        <input type="text" class="form-control" id="qr-input-app-secret-key" value="{{ @$App->secret_key }}" disabled>
    </div>
    <a href="{{ url('app/edit/'.$App->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
    <a href="{{ url('app/delete/'.$App->id) }}" class="btn btn-danger">{{ __('Delete') }}</a>
@endsection
