<!doctype html>
<html lang="en">
<head>
    <title>DailyInput</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col col-lg-12 " >
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-xs-6">
                            <h3 class="panel-title">DailyInputs</h3>
                        </div>
                        <div class="col col-xs-6 text-right">
                            <a class="btn btn-sm btn-primary btn-create" href="{{ URL::to('home') }}" role="button">Goto Home</a>
                            <a class="btn btn-sm btn-primary btn-create" href="{{ URL::to('dailyInput/create') }}" role="button">Create New</a>
                        </div>
                    </div>
                </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>

                            <tr>
                                <th>#</th>
                                <th>Staff Name</th>
                                <th>Client Name</th>
                                <th>created</th>
                                <th>Report Date</th>
                                <th>Time From</th>
                                <th>Time To</th>
                                <th>Total Time</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $SerialNum= 0;?>
                            @foreach($dailyInputs as $dailyInput)
                                <?php $SerialNum++;?>

                            <tr>
                                <td>{{$SerialNum}}</td>
                                <td>{{$dailyInput->staffDetail->name}}</td>
                                <td>{{$dailyInput->client->name}}</td>
                                <td>{{$dailyInput->created}}</td>
                                <td>{{$dailyInput->reportDate}}</td>
                                <td>{{$dailyInput->timeFrom}}</td>
                                <td>{{$dailyInput->timeUpto}}</td>
                                <td>{{$dailyInput->timeTotal}}</td>
                                <td>
                                    <form action="{{ route('dailyInput.destroy',    $dailyInput->id) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <div class="btn-group">
                                            <button class="btn btn-sm">Delete</button>
                                        </div>
                                    </form>
                <a class="btn btn-sm" href="{{ URL::to('dailyInput/'.$dailyInput->id.'/edit/') }}">Edit</a>



                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>