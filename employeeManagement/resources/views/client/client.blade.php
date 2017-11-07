<!doctype html>
<html lang="en">
<head>
    <title>Admin</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}} " />
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.min.css')}} " />
    <link rel="stylesheet" href="{{asset('css/style.css')}} " />



    <script src="{{asset('js/jquery-3.2.1.min.js')}} "></script>
</head>
<body>
<header>
    <div class="container">
        <div class="header-main">
            <div class="leftNav">
                <nav>
                    <ul>
                        <li class="active"><a href="{{ URL::to('client') }}">Clients </a></li>
                        <li><a href="{{ URL::to('staffDetail') }}">Staff </a></li>
                        <li><a href="{{ URL::to('task') }}">Task </a></li>
                        <li><a href="{{ URL::to('designation') }}">Designation </a></li>
                        <li><a href="{{ URL::to('charge') }}">Charges </a></li>
                        <li><a href="{{ URL::to('dailyInput') }}">DailyInputs </a></li>
                        <li><a href="{{ URL::to('admin') }}">Admin </a></li>
                    </ul>
                </nav>
            </div>
            <div class="rightNav">
                <a href="#">Login</a>
            </div>
        </div>
    </div>
</header>
<section class="main">
    <div class="container">
        <h2 class="heading-main">Client  <span class="addIcon" data-toggle="modal" data-target="#myModal" onclick="$('#formFirst')[0].reset();"><i><img src="{{asset('img/add.png')}}" alt=""></i>Add</span></h2>

        <div class="row">
            <div class="col-sm-12">
                <div class="main-table">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Contact Person</th>
                            <th>Ntn</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(isset($clients))
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{$client->name}}</td>
                                    <td>{{$client->address}}</td>
                                    <td>{{$client->contact}}</td>
                                    <td>{{$client->contactPerson}}</td>
                                    <td>{{$client->nic}}</td>
                                    <td>
                                        <ul class="list-inline">
                                            <li>
                                                {{--<a href="{{ URL::to('client/'.$client->id.'/edit/') }}" ><img src="{{asset('img/edit.png')}}" alt=""></a>--}}
                                                <a href="#" data-toggle="modal" data-target="#myModal2" onclick="edit_book({{$client->id}})" ><img src="{{asset('img/edit.png')}}" alt=""></a>
                                            </li>
                                            <li><a href="{{ URL::to('client/delete/'.$client->id) }}"><img src="{{asset('img/remove.png')}}" alt=""></a></li>
                                            <li><a href="#"><img src="{{asset('img/recycle.png')}}" alt=""></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade modal-small" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span data-dismiss="modal" aria-label="Close" aria-hidden="true" class="closeFixed">&times;</span>
                <h2 class="modal-title" id="myModalLabel">Client Detail</h2>
            </div>


            <form class="form-signin" method="post" action="{{ URL::to('client') }}" id="formFirst">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <input name="inputName" type="text" placeholder="Name">
                    <input type="text" name="inputAddress" placeholder="Address">
                    <input type="text" name="inputContact" placeholder="Phone Number">
                    <input type="text" name="inputContactPerson" placeholder="Contact Person">
                    <input type="text" name="inputnic" placeholder="NTN">
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <button type="submit" >Submit</button>
                        </div>
                        <div class="col-xs-6 text-center">
                            <button type="button" data-dismiss="modal">Exit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- loop modal -->
<div class="modal fade modal-small" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span data-dismiss="modal" aria-label="Close" aria-hidden="true" class="closeFixed">×</span>
                <h2 class="modal-title" id="myModalLabel">Client Update</h2>
            </div>
            <form action="{{ url::to('client/update') }}" method="POST" id="form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <input name="inputName" type="text" placeholder="Name">
                    <input type="text" name="inputAddress" placeholder="Address">
                    <input type="text" name="inputContact" placeholder="Phone Number">
                    <input type="text" name="inputContactPerson" placeholder="Contact Person">
                    <input type="text" name="inputnic" placeholder="NTN">
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-6 text-center">
                            <button type="submit" >Submit</button>
                        </div>
                        <div class="col-sm-6 text-center">
                            <button type="button" data-dismiss="modal">Exit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

        <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
        <script>
            $(document).ready(function () {
                $(".datepick").datepicker({format: 'yyyy-mm-dd'});
            })

            function edit_book(id) {
                save_method = 'update';
                $('#form')[0].reset(); // reset form on modals
                var uri = '{{URL::to('/')}}';
                //Ajax Load data from ajax
                $.ajax({
                    url: "{{ URL::to('client')}}" +"/"+id+ '/edit/',
                    type: "GET",
                    dataType: "JSON",
                    success: function (data) {

                        //console.log(data);
                        $('[name="id"]').val(data.id);
                        $('[name="inputName"]').val(data.name);
                        $('[name="inputAddress"]').val(data.address);
                        $('[name="inputContact"]').val(data.contact);
                        $('[name="inputContactPerson"]').val(data.contactPerson);
                        $('[name="inputnic"]').val(data.nic);

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error get data from ajax');
                    }
                });0
            }

        </script>


</body>
</html>