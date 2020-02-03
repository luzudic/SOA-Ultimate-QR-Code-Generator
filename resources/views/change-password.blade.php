@extends('layouts.app')

@section('content')
    <form action="{{ route('password-update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="password">{{ __('New Password:') }}</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                   placeholder="Enter New Password"
                   name="password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <input type="password" class="form-control" id="password-confirm" placeholder="Re-type PAssword" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
@endsection
