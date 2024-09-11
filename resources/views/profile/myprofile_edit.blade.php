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
                                                    <h4 class="panel-title">
                                                            Basic Information
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse">
                                                    {!! Form::open(['url'=>'myprofile-update','files'=>true]) !!}
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="contacts-name">Name</label>
                                                                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" id="contacts-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="contacts-name">Email</label>
                                                                    <input type="text" name="email" value="{{ Auth::user()->email }}"  class="form-control" id="contacts-name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="contacts-name">Phone</label>
                                                                    <input type="text" required name="phone" value="{{ Auth::user()->phone }}"  class="form-control" id="contacts-name">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="contacts-name">Father Name</label>
                                                                    <input type="text" name="father_name" value="{{ Auth::user()->father_name }}" required  class="form-control" id="contacts-name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="contacts-name">Mother Name</label>
                                                                    <input type="text" name="mother_name" value="{{ Auth::user()->mother_name }}"  required class="form-control" id="contacts-name">
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="contacts-name">Date of Birth</label>
                                                                    <input type="text" name="dob" autocomplete="off" value="{{ Auth::user()->dob }}" required class="form-control input-append date" id="datepicker">
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="contacts-name">Image</label>
                                                                            <input type="file" name="image">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <a target="_blank" href="{{ Storage::url(Auth::user()->image) }}"><img src="{{ Storage::url(Auth::user()->image) }}" height="50" alt=""></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>








                                                        <fieldset>
                                                            <legend>Address</legend>

                                                            <div class="form-group">
                                                                <label for="contacts-name">Present Address</label>
                                                                <input type="text" name="present_address" value="{{ Auth::user()->present_address }}"  class="form-control" id="contacts-name">
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="contacts-name">Division</label>
                                                                        <div class="divisions-list">
                                                                            @php $divisions->prepend('বিভাগ নির্বাচন করুন','')  @endphp
                                                                            {!! Form::select('division_id', $divisions, Auth::user()->division_id,['class'=>'form-control','required'=>'required']) !!}
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="contacts-name">District</label>
                                                                        <div class="districts-list">
                                                                            @php $districts->prepend('জেলা নির্বাচন করুন','')  @endphp
                                                                            {!! Form::select('district_id', $districts, Auth::user()->district_id,['class'=>'form-control','required'=>'required']) !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="contacts-name">Villege</label>
                                                                        <input type="text" name="per_villlege" required value="{{ Auth::user()->per_villlege }}"  class="form-control" id="contacts-name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="contacts-name">Thana</label>
                                                                        <div class="upzilla-list">
                                                                            @php $upazilas->prepend('উপজেলা নির্বাচন করুন','')  @endphp
                                                                            {!! Form::select('upzilla_id', $upazilas, Auth::user()->upzilla_id,['class'=>'form-control','required'=>'required']) !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>





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

            /*$('#datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: '1900-01-01',
                    endDate: '2020-12-30',
                })*/

            var var_gender = "{{Auth::user()->gender}}";

            if(var_gender=='Female'){
                $('.maharram-info').show('slow');
                $('.maharram-info input').attr('required','required');
            }else{
                $('.maharram-info').hide('slow');
                $('.maharram-info input').removeAttr('required');
            }

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