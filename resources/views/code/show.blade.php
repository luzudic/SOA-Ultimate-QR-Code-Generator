@extends('layouts.app')

@section('css')

@endsection

@section('content')
    <div class="text-right">
        <div class="form-group">
            <a href="{{ url('app/code/edit/'.@$Code->id) }}" class="btn btn-primary"><i
                        class="fa fa-edit"></i>{{ __(' Edit') }}</a>
        </div>
    </div>
    <div class="text-center">
        <div class="form-group">
            <img src="{{ @$Code->code }}" style="width: 200px; height: 200px;"/>
        </div>
        <div class="form-group">
            <h1>
                <a href="{{ url('/app/code/visitor?code_id='.@$Code->id) }}">{{ __('Total Visits: '.@$Code->visits) }}</a>
            </h1>
        </div>
    </div>
    <div class="form-group">
        <label for="name">{{ __('Name:') }}</label>
        <input type="text" class="form-control" id="name" value="{{ @$Code->name }}" disabled>
    </div>
    <div class="form-group">
        <label for="url">{{ __('URL:') }}</label>
        <input type="text" class="form-control" id="url" value="{{ @$Code->url }}" disabled>
    </div>
    <div class="form-group">
        <div id="qr-chart-div" style="width: 100%; height: 500px;"></div>
    </div>

@endsection

@section('js')
    <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['geochart'],
            'mapsApiKey': 'AIzaSyCINS2dyuBipK8MZzOQnzyKdrS2I1_b5I4'
        });
        google.charts.setOnLoadCallback(drawRegionsMap);

        function drawRegionsMap() {

            let ajax_url = "{{ url('api/chart/'.@$Code->id) }}"

            let result = $.ajax({
                url: ajax_url,
                method: 'get',
                data: {},
                async: false,
                success: function (response) {
                    return response;
                }

            });

            $array = [
                ['Country', 'Visitors'],
            ];

            result.responseJSON.forEach(function (item) {
                $array.push([item['country'], item['visitors']]);
            })

            let data = google.visualization.arrayToDataTable($array);

            let options = {};

            let chart = new google.visualization.GeoChart(document.getElementById('qr-chart-div'));

            chart.draw(data, options);
        }
    </script>
@endsection
