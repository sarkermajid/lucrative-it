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
                                                    <h4 class="panel-title">Passport <a class="text-right" style="float: right" href="{{ url('passport-edit') }}">Edit</a></h4>
                                                </div>
                                                <div class="panel-collapse">
                                                    <div class="panel-body">
                                                        @if($passport_info)
                                                            <table class="table table-hover">
                                                                <tbody>
                                                                <tr>
                                                                    <th>Passport No</th>
                                                                    <td>{{ $passport_info->passport_no }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Issue Date</th>
                                                                    <td>{{ $passport_info->issue_date }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Expire Date</th>
                                                                    <td>{{ $passport_info->expired_date }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Issue Place</th>
                                                                    <td>{{ $passport_info->issue_place }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Passport Photo</th>
                                                                    <td><a target="_blank" href="{{ Storage::url($passport_info->passport_photo) }}"><img src="{{ Storage::url($passport_info->passport_photo) }}" height="50" alt=""></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Passport Type</th>
                                                                    <td>{{ $passport_info->passport_type }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Pussport Submit</th>
                                                                    <td>{{ $passport_info->is_submit_passport }}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        @else
                                                            {!! Form::open(['url'=>'passport-insert','files'=>true]) !!}
                                                                <div class="form-group">
                                                                    <label for="contacts-name">Passport No</label>
                                                                    <input type="text" required name="passport_no" value="{{ old('passport_no') }}"  class="form-control" id="contacts-name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="contacts-name">Issue Date</label>
                                                                    <input type="text" required name="issue_date" value="{{ old('issue_date')   }}"  class="form-control input-append date" id="datepicker1">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="contacts-name">Expire Date</label>
                                                                    <input type="text" required name="expired_date" value="{{ old('expired_date')  }}"  class="form-control input-append date" id="datepicker2">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="contacts-name">Issue Place</label>
                                                                    <input type="text" required name="issue_place" value="{{ old('issue_place')  }}"  class="form-control">
                                                                </div>

                                                            <div class="form-group">
                                                                <label for="contacts-name">Passport Type</label>
                                                                <select name="passport_type" required class="form-control">
                                                                    <option value="">Select Passport Type</option>
                                                                    <option  value="Ordinary international passport">Ordinary international passport</option>
                                                                    <option value="Official passport">Official passport</option>
                                                                    <option value="Diplomatic passport">Diplomatic passport</option>
                                                                </select>
                                                            </div>

                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="contacts-name">Passport Photo</label>
                                                                            <input type="file" name="passport_photo">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="contacts-name">  আপনার পাসপোর্ট জমা দিয়েছেন কি? </label><br>
                                                                    <label class=""><input type="radio" value="হ্যাঁ" name="is_submit_passport">হ্যাঁ</label>
                                                                    <label class=""><input type="radio" value="না" name="is_submit_passport">না</label>
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