<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <a href="{{ URL::to('client') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" >Clients</a>
        <a href="{{ URL::to('designation') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Designation</a>
        <a href="{{ URL::to('task') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Task</a>
        <a href="{{ URL::to('staffDetail') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Staff Detail</a>
        <a href="{{ URL::to('charge') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Charges</a>
        <a href="{{ URL::to('dailyInput') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">DailyInputs</a>
        <a href="{{ URL::to('admin') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Admin</a>
    </div>
    <div class="col-lg-2"></div>
</div>
</body>
</html>
