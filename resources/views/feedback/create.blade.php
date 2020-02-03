@extends('layouts.app')

@section('content')
    <form action="{{ route('feedback-store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="subject">{{ __('Subject') }}</label>
            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject"
                   placeholder="Max 50 Characters"
                   name="subject" maxlength="50">
            @error('subject')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="message">{{ __('Message:') }}</label>
            <textarea class="form-control @error('message') is-invalid @enderror" id="message" placeholder="Max 255 Characters" rows="3" name="message" maxlength="255"></textarea>
            @error('message')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
@endsection
