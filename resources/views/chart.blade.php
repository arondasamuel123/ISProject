<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Student Gigs </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        #pie2 {
            float: top;
               
        }
        </style>
<body>
<div  style="width:50%;">
{!! $chart->container() !!}
</div>
<br>
<br>

<div style="width:50%;">
{!! $pie->container() !!}

<a href="/gigscompleted" class="btn btn-primary">Export to PDF</a>
</div>

<div id="pie2" style="width:50%; ">
    {!! $pie2->container() !!}
    
    <a href="/reqcompleted" class="btn btn-primary">Export to PDF</a>
    </div>
<br>
<br>
    <div>
        <h3> Reports:</h3>
        <br>
        <a href="/reqcompleted" class="btn btn-primary">Gig Classification Report</a>
        <a href="/reqcompleted" class="btn btn-success">Skills Classification Report</a>
    </div>
    <br>
    <a href="/home" class="btn btn-warning">Back to Dashboard</a>    

<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $chart->script() !!}
{!! $pie->script() !!}
{!! $pie2->script() !!}
</body>
</html>