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
                                                    <h4 class="panel-title">Passport</h4>
                                                </div>
                                                <div class="panel-collapse">
                                                    {!! Form::open(['url'=>'educational-info-update','files'=>true]) !!}
                                                    <div class="panel-body">
                                                        <div class="form-group">
                                                            <label for="contacts-name">University/Institute Name</label>
                                                            <input type="text" name="institute_name" value="{{ $educational_info->institute_name }}"  class="form-control" id="contacts-name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="contacts-name">Office Contact Number</label>
                                                            <input type="text" name="officer_contact_number" value="{{ $educational_info->officer_contact_number }}"  class="form-control" id="contacts-name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="contacts-name">Address</label>
                                                            <input type="text" name="address" value="{{ $educational_info->address }}"  class="form-control" id="contacts-name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="contacts-name">Class/Year</label>
                                                            <input type="text" name="class_year" value="{{ $educational_info->class_year }}"  class="form-control" id="contacts-name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="contacts-name">Branch Name</label>
                                                            <input type="text" name="branch_name" value="{{ $educational_info->branch_name }}"  class="form-control" id="contacts-name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="contacts-name">Course Title</label>
                                                            <input type="text" name="course_title" value="{{ $educational_info->course_title }}"  class="form-control" id="contacts-name">
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
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

            $('[name="gender"]').on('change', function() {
                var gender = $(this).val();

                if(gender=='Male'){
                    $('.maharram-info').hide('slow');
                    $('.maharram-info input').removeAttr('required');
                }else{
                    $('.maharram-info').show('slow');
                    $('.maharram-info input').attr('required','required');
                }
            })

            $('[name="division_id"]').on('change', function() {
                var division_id = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: '/division-district',
                    dataType: 'HTML',
                    data: {division_id: division_id},
                    success: function( msg ) {
                        $('.districts-list').html(msg);
                    }
                });
            })


            $("body").on( "change", "[name='district_id']", function() {
                var district_id = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: '/district-upzilla',
                    dataType: 'HTML',
                    data: {district_id: district_id},
                    success: function( msg ) {
                        $('.upzilla-list').html(msg);
                    }
                });
            })
        })

    </script>



@endsection