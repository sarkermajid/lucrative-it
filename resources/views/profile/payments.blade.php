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
                                                        <table class="table table-hover">
                                                            <tr>
                                                                <th>Course Name</th>
                                                                <th>Course Fee</th>
                                                                <th>Diccount</th>
                                                                <th>Total Payment</th>
                                                                <th>Actions</th>
                                                            </tr>

                                                            @foreach($payments as $payment)
                                                                <tr>
                                                                    <td>{{ $payment->course->title }}</td>
                                                                    <td>{{ $payment->course_fee }}</td>
                                                                    <td>{{ $payment->discount }}</td>
                                                                    <td>{{ $payment->total_amount }}</td>
                                                                    <td><a href="{{ url('payment/'.$payment->id) }}">View/Print</a></td>
                                                                </tr>

                                                            @endforeach
                                                        </table>
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

        })

    </script>



@endsection