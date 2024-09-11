@extends('layouts.app')

@section('content')
    <!-- BEGIN SLIDER -->
    <div class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">My Profile</li>
            </ul>
            <div class="row margin-bottom-40">
                <div class="col-md-12 col-sm-12">
                    <div class="content-page">
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                @include('layouts.profile_left')
                            </div>
                            <div class="col-md-9 col-sm-9">
                                <div class="tab-content" style="padding:0; background: #fff;">
                                    <!-- START TAB 1 -->
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="panel-group" id="accordion1">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">Payments <a class="text-right" style="float: right" href="{{ url('payment-add') }}">Add</a></h4>
                                                </div>
                                                <div class="panel-collapse">
                                                    <div class="panel-body">

                                                        {!! Form::open(['url'=>'payment-insert','files'=>true]) !!}

                                                        <div class="form-group">
                                                            <label>Select Course</label>
                                                            @php $courses->prepend('Select Course','')  @endphp
                                                            {!! Form::select('course_id', $courses, old('course_id'),['class'=>'form-control']) !!}<i></i>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="contacts-name">Amount</label>
                                                            <input type="text" name="amount" value=""  class="form-control" id="contacts-name">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="contacts-name">Transaction ID</label>
                                                            <input type="text" name="trabsaction_id" required value=""  class="form-control" id="contacts-name">
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Submit</button>

                                                        {!! Form::close() !!}

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT -->
            </div>
        </div>
    </div>

@endsection

@section('js')




    <script type="text/javascript">

        $(document).ready(function() {

// countdown



            jQuery(function(){
                $('#ic-countdown').simplyCountdown({
                    year: '@php echo date('Y',strtotime(settings('countdown_ending_date', $settings))) @endphp',
                    month: '@php echo date('n',strtotime(settings('countdown_ending_date', $settings))) @endphp',
                    day: '@php echo date('j',strtotime(settings('countdown_ending_date', $settings) )) @endphp',
                    hours: '@php echo date('G',strtotime(settings('countdown_ending_time', $settings))) @endphp',
                    minutes: '@php echo date('i',strtotime(settings('countdown_ending_time', $settings))) @endphp'
                    // enableUtc: false
                });
            });
        })

    </script>



@endsection