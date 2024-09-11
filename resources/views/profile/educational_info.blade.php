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
                                                    <h4 class="panel-title">Passport <a class="text-right" style="float: right" href="{{ url('educational-info-edit') }}">Edit</a></h4>
                                                </div>
                                                <div class="panel-collapse">
                                                    <div class="panel-body">
                                                        @if($educational_info)
                                                            <table class="table table-hover">
                                                                <tbody>
                                                                <tr>
                                                                    <th>University/Institute Name</th>
                                                                    <td>{{ $educational_info->institute_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Office Contact Number</th>
                                                                    <td>{{ $educational_info->officer_contact_number }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Address</th>
                                                                    <td>{{ $educational_info->address }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Class/Year</th>
                                                                    <td>{{ $educational_info->class_year }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Branch Name</th>
                                                                    <td>{{ $educational_info->branch_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Course Title</th>
                                                                    <td>{{ $educational_info->course_title }}</td>
                                                                </tr>

                                                                </tbody>
                                                            </table>
                                                        @else
                                                            {!! Form::open(['url'=>'educational-info-insert','files'=>true]) !!}
                                                                <div class="form-group">
                                                                    <label for="contacts-name">University/Institute Name</label>
                                                                    <input type="text" required name="institute_name" value="{{ old('institute_name') }}"  class="form-control" id="contacts-name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="contacts-name">Office Contact Number</label>
                                                                    <input type="text" required name="officer_contact_number" value="{{ old('officer_contact_number') }}"  class="form-control" id="contacts-name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="contacts-name">Address</label>
                                                                    <input type="text" required name="address" value="{{ old('address') }}"  class="form-control" id="contacts-name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="contacts-name">Class/Year</label>
                                                                    <input type="text" required name="class_year" value="{{ old('class_year') }}"  class="form-control" id="contacts-name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="contacts-name">Branch Name</label>
                                                                    <input type="text" required name="branch_name" value="{{ old('branch_name') }}"  class="form-control" id="contacts-name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="contacts-name">Course Title</label>
                                                                    <input type="text" required name="course_title" value="{{ old('course_title') }}"  class="form-control" id="contacts-name">
                                                                </div>



                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            {!! Form::close() !!}
                                                        @endif
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

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>


    <script type="text/javascript">

        $(document).ready(function() {

            $('#datepicker1').datepicker({
                format: 'yyyy-mm-dd',
                startDate: '1900-01-01',
                endDate: '2020-12-30',
            })

            $('#datepicker2').datepicker({
                format: 'yyyy-mm-dd',
                startDate: '1900-01-01',
                endDate: '2020-12-30',
            })

            $('#datepicker3').datepicker({
                format: 'yyyy-mm-dd',
                startDate: '1900-01-01',
                endDate: '2020-12-30',
            })

        })

    </script>



@endsection