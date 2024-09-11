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
                                                    <h4 class="panel-title">Basic Information <a class="text-right" style="float: right" href="{{ url('myprofile-edit') }}">Edit</a></h4>
                                                </div>
                                                <div class="panel-collapse">
                                                    <div class="panel-body">
                                                        <table class="table table-hover">
                                                            <tbody>
                                                            <tr>
                                                                <th>Name</th>
                                                                <td>{{ Auth::user()->title.' '.Auth::user()->name }}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Mother Name</th>
                                                                <td>{{ Auth::user()->mother_name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Father Name</th>
                                                                <td>{{ Auth::user()->father_name }}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Date of Birth</th>
                                                                <td>{{ (Auth::user()->dob !='0000-00-00')?Auth::user()->dob:'' }}</td>
                                                            </tr>


                                                            <tr>
                                                                <th>Image</th>
                                                                <td><a target="_blank" href="{{ Storage::url(Auth::user()->image) }}"><img src="{{ Storage::url(Auth::user()->image) }}" height="50" alt=""></a></td>
                                                            </tr>


                                                            <tr>
                                                                <th>Present Address</th>
                                                                <td>{{ Auth::user()->present_address }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Division</th>
                                                                <td>{{ $add['division'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>District</th>
                                                                <td>{{ $add['district'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Upazilla</th>
                                                                <td>{{ $add['upazila'] }}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Villege</th>
                                                                <td>{{ Auth::user()->per_villlege }}</td>
                                                            </tr>





                                                            </tbody>
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