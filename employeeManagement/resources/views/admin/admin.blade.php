<!doctype html>
<html lang="en">
<head>
    <title>Admin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>
<body>
<div class="container"  id ="container">
    <div class="row">
        <div class="col col-lg-12 " >
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-xs-6">
                            <h3 class="panel-title">Admin</h3>
                        </div>
                        <div class="col col-xs-6 text-right">
                            <a class="btn btn-sm btn-primary btn-create" href="{{ URL::to('home') }}" role="button">Goto Home</a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>

                        <tr>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Staff</th>
                            <th>Designation</th>
                            <th>Hours</th>
                            <th>Rate</th>
                            <th>Total Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                            <td>
                                <label for="inputDate" class="sr-only">Date</label>
                                <input type="date" id="inputDate" name="inputDate" class="form-control" value="" required autofocus onchange="handler(event);">
                            </td>

                            <td>
                                <select name="inputClient" id="inputClient">
                                    <option value="0" label="--- Select ---"/>
                                    @foreach($clients as $client)
                                        <option value="{{$client->id}}" label="{{$client->name}}"/>
                                    @endforeach
                                </select>
                                </td>
                            <td>
                                <select name="inputStaffDetail" id="inputStaffDetail">
                                    <option value="0" label="--- Select ---"/>
                                    @foreach($staffDetails as $staffDetail)
                                        <option value="{{$staffDetail->id}}" label="{{$staffDetail->name}}" dept-name="{{$staffDetail->designation->title}}" dept-rate="{{$staffDetail->designation->charge->last()->rate}}"/>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <label for="inputTitle" class="sr-only">Title</label>
                                <input type="text" id="inputTitle" name="inputTitle" class="form-control" value="" required autofocus readonly>
                            </td>
                            <td>
                                <label for="inputHours" class="sr-only">Hours</label>
                                <input type="text" id="inputHours" name="inputHours" class="form-control" value="" required autofocus readonly></td>
                            <td>
                                <label for="inputRate" class="sr-only">Rate</label>
                                <input type="text" id="inputRate" name="inputRate" class="form-control" value="" required autofocus readonly>
                            </td>

                            <td>
                                <label for="inputAmount" class="sr-only">Amount</label>
                                <input type="text" id="inputAmount" name="inputAmount" class="form-control" value="" required autofocus readonly>
                            </td>


                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
{{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function($){

        $('#inputStaffDetail').change(function(){

            $('#inputTitle').val('');
            $('#inputRate').val('');
            $('#inputHours').val('');
            $('#inputAmount').val('');

            var staffID = $(this).val();
            var deptName = $(this).find(":selected").attr('dept-name');
            var deptRate = $(this).find(":selected").attr('dept-rate');

            $('#inputTitle').val(deptName);
            $('#inputRate').val(deptRate);

            $.ajax({
                url: '/admin/dropdown/',
                type: 'GET',
                data: {_token: CSRF_TOKEN,staffID:staffID},
                dataType: 'JSON',
                success: function (data) {
                    var hours = data.timeTotal;
                    var sp = hours.split(":");
                    var h = sp[0];
                    var m = sp[1];
                    var tph = h*deptRate;
                    var tpm = m*deptRate;
                    var totalPrice = tph+tpm;

                    $('#inputHours').val(hours);
                    $('#inputAmount').val(totalPrice);

                }
            });
        });

        $('#inputClient').change(function(){

            $('#inputTitle').val('');
            $('#inputRate').val('');
            $('#inputHours').val('');
            $('#inputAmount').val('');

            var clientID = $(this).val();

            if(clientID == 0){
                location.reload();
            }else{
                $.ajax({
                    url: '/admin/dropdown/',
                    type: 'GET',
                    data: {_token: CSRF_TOKEN,clientID:clientID},
                    dataType: 'JSON',
                    success: function (data) {
                        $("select[name=inputStaffDetail").html('');
                        var empty_data = "<option value="+0+" label="+'---Select---'+"/>";
                        $(empty_data).appendTo('#inputStaffDetail');
                        $.each(data,function(key,val){
                            var div_data="<option value="+val.staff_id+" label = "+val.staff_name+" dept-name="+val.designation_id+" dept-rate="+val.rate+"/>";
                            $(div_data).appendTo('#inputStaffDetail');
                        })

                    }
                });
            }
        });
    });

    function handler(e){
        var datepicked = e.target.value;

        $('#inputTitle').val('');
        $('#inputRate').val('');
        $('#inputHours').val('');
        $('#inputAmount').val('');

        $.ajax({
            url: '/admin/dropdown/',
            type: 'GET',
            data: {_token: CSRF_TOKEN,datepicked:datepicked},
            dataType: 'JSON',
            success: function (data) {
                $("select[name=inputClient").html('');
                $("select[name=inputStaffDetail").html('');
                var empty_data = "<option value="+0+" label="+'---Select---'+"/>";
                $(empty_data).appendTo('#inputClient');
                $(empty_data).appendTo('#inputStaffDetail');
                $.each(data,function(key,val){
                    var div_data="<option value="+val.client_id+" label = "+val.client_name+" />";
                    $(div_data).appendTo('#inputClient');
                })

            }
        });
    }
</script>
</body>
</html>