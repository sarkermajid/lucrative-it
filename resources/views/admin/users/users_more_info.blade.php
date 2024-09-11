@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>More Info<small>More Info</small></h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                {!! Form::open(['url'=>'more-info','files'=>true]) !!}
                <div class="col-xs-9">
                    <div class="box">
                        <!-- form start -->
                        <div class="box-header">

                            @if(Session::has('message'))
                                <div class="allert-message alert-success-message pgray  alert-lg" role="alert">
                                    <p> {{ Session::get('message') }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="box-body">
                            <input type="hidden" value="{{$more_info->id}}" name="id">
                            <input type="hidden" value="{{$more_info->users_id}}" name="users_id">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">Salaray</label>
                                        <input type="text" name="salary" value="{{ $more_info->salary }}" placeholder="Enter Salary" id="salary" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Purpose of salary change</label>
                                        <input type="text" name="purpose" value="{{ $more_info->purpose }}" placeholder="Enter Purpose of salary change" id="purpose" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">Team</label>
                                        {!! Form::select('team_id', $team, $more_info->team_id,['class'=>'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Address</label>
                                        <input type="text" name="address" value="{{ $more_info->address }}" placeholder="Enter Address" id="purpose" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Joining Date:</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" value="@php echo ($more_info->joining_date)?date('Y-m-d',strtotime($more_info->joining_date)):'' @endphp"   name="joining_date" class="form-control pull-right" id="datepicker1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Expire Date:</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" value="@php echo ($more_info->expire_date)?date('Y-m-d',strtotime($more_info->expire_date)):'' @endphp"  name="expire_date" class="form-control pull-right" id="datepicker2">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Confirmation Date (After Probation):</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" value="@php echo ($more_info->confirmation_date)?date('Y-m-d',strtotime($more_info->confirmation_date)):'' @endphp"   name="confirmation_date" class="form-control pull-right" id="datepicker3">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Voter ID Card</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="file" name="national_id"   class="form-control">
                                    </div>
                                    @if($more_info->national_id)
                                    <div class="col-md-6">
                                        <a href="{{asset($more_info->national_id)}}" target="_blank" alt="">Voter ID Card</a>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Graduate Cerfificate</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="file" name="graduate_certificate"   class="form-control">
                                    </div>
                                    @if($more_info->graduate_certificate)
                                    <div class="col-md-6">
                                        <a href="{{asset($more_info->graduate_certificate)}}" target="_blank" alt="">Graduate Cerfificate</a>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">CV</label>
                                <div class="row">
                                    <div class="col-md-6">
                                         <input type="file" name="cv"   class="form-control">
                                    </div>
                                    @if($more_info->cv)
                                    <div class="col-md-6">
                                        <a href="{{asset($more_info->cv)}}" target="_blank" alt="">CV</a>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Others 1</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="file" name="others1"   class="form-control">
                                    </div>
                                    @if($more_info->others1)
                                        <div class="col-md-6">
                                            <a href="{{asset($more_info->others1)}}" target="_blank" alt="">Others 1</a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Others 2</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="file" name="others2"   class="form-control">
                                    </div>
                                    @if($more_info->others2)
                                        <div class="col-md-6">
                                            <a href="{{asset($more_info->others2)}}" target="_blank" alt="">Others 2</a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button class="btn btn-primary" type="submit">Submit</button> <a href="{{url('employees')}}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')

    <!-- Morris.js charts -->
    <script src="{{ asset('js/raphael.min.js') }}"></script>
    <script src="{{ asset('js/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('js/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('js/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('js/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('js/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('js/demo.js') }}"></script>

    <script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
    <script>
        $(function () {

            //Date picker

            $('#datepicker1').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
            }).datepicker("setDate", today_date());

            $('#datepicker2').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
            })

            $('#datepicker3').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
            })

            function today_date() {
                var d = new Date();

                var year = d.getFullYear();
                var month = d.getMonth()+1;
                var day = d.getDate();

                var output = year + '-' +
                    ((''+month).length<2 ? '0' : '') + month + '-' +
                    ((''+day).length<2 ? '0' : '') + day;
                return output;
            }
        })
    </script>


@endsection