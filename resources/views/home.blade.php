@extends('layouts.app')

@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


    <div class="card-deck">

        @if(isset($TotalUsers))
            <div class="card border-primary mb-3" style="max-width: 18rem;">
                <div class="card-body text-primary">
                    <h5 class="card-title">{{ 'Total Users ' }}</h5>
                    <h1 class="card-title">{{ $TotalUsers }}</h1>
                </div>
            </div>
        @endif

        <div class="card border-primary mb-3" style="max-width: 18rem;">
            <div class="card-body text-primary">
                <h5 class="card-title">{{ 'Total Apps ' }}</h5>
                <h1 class="card-title">{{ $TotalApps }}</h1>
            </div>
        </div>

        <div class="card border-primary mb-3" style="max-width: 18rem;">
            <div class="card-body text-primary">
                <h5 class="card-title">{{ 'Total Codes' }}</h5>
                <h1 class="card-title">{{ $TotalCodes }}</h1>
            </div>
        </div>

    </div>




@endsection
