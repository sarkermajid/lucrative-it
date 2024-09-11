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
                                                    <h4 class="panel-title">Basic Information @if($contact_info)<a class="text-right" style="float: right" href="{{ url('contact-info-edit') }}">Edit</a>@endif</h4>
                                                </div>
                                                <div class="panel-collapse">
                                                    <div class="panel-body">
                                                        @if($contact_info)
                                                            <table class="table table-hover">
                                                                <tbody>
                                                                <tr>
                                                                    <th>Mobile No*:</th>
                                                                    <td>{{ $contact_info->phone }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Home No</th>
                                                                    <td>{{ $contact_info->home_phone }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Email</th>
                                                                    <td>{{ $contact_info->email }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Reference</th>
                                                                    <td>{{ $contact_info->reference }}</td>
                                                                </tr>

                                                                </tbody>
                                                            </table>

                                                        @else
                                                            {!! Form::open(['url'=>'physical-info-insert','files'=>true]) !!}

                                                                <div class="form-group">
                                                                    <label for="contacts-name">আপনার জটিল রোগ থাকলে বিস্তারিত লিখুন </label>
                                                                    <input type="text" name="strong_disease" value=""  class="form-control" id="contacts-name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="contacts-name"> রক্ত চাপের অবস্থা লিখুন  </label>
                                                                    <input type="text" name="blood_pressure" required value=""  class="form-control" id="contacts-name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="contacts-name"> রক্তের গ্রুপ  </label>
                                                                    <select name="blood_group" required class="form-control" id="sel1">
                                                                        <option value="">রক্তের গ্রুপ নির্বাচন করুন</option>
                                                                        <option  value="O+">O+</option>
                                                                        <option  value="O-">O-</option>
                                                                        <option  value="A+">A+</option>
                                                                        <option  value="A-">A-</option>
                                                                        <option  value="B+">B+</option>
                                                                        <option  value="B-">B-</option>
                                                                        <option  value="AB+">AB+</option>
                                                                        <option  value="AB-">AB-</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="contacts-name"> ডায়াবেটিস এর অবস্থা লিখুন  </label>
                                                                    <input type="text" name="diabetes" required   class="form-control" id="contacts-name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="contacts-name"> খাবারে  মৌলিক সমস্যা থাকলে লিখুন </label>
                                                                    <input type="text" name="food_problem"  class="form-control" id="contacts-name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="contacts-name"> হাঁটা-চলায় সমস্যা থাকলে লিখুন  </label>
                                                                    <input type="text" name="walking_problem"   class="form-control" id="contacts-name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="contacts-name">  ইংলিশ কমোড ব্যবহার করেছেন?  </label><br>
                                                                    <label class=""><input type="radio" required  value="হ্যাঁ" name="is_use_english_commode">হ্যাঁ</label>
                                                                    <label class=""><input type="radio" required  value="না" name="is_use_english_commode">না</label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="contacts-name"> দেখে-দেখে কুরআন পরতে পারেন?  </label><br>
                                                                    <label class=""><input type="radio" required  value="হ্যাঁ" name="is_reading_quran">হ্যাঁ</label>
                                                                    <label class=""><input type="radio" required  value="না" name="is_reading_quran">না</label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="contacts-name"> সহীহভাবে কুরআন পরতে পারেন?  </label><br>
                                                                    <label class=""><input type="radio" required  value="হ্যাঁ" name="is_read_quran_sahih">হ্যাঁ</label>
                                                                    <label class=""><input type="radio" required  value="না" name="is_read_quran_sahih">না</label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="contacts-name"> সালাতের সূরা ও তাজবীহ সহীহভাবে পড়তে পারেন?  </label><br>
                                                                    <label class=""><input type="radio" required value="হ্যাঁ" name="is_salat_sahih_reading">হ্যাঁ</label>
                                                                    <label class=""><input type="radio" required value="না" name="is_salat_sahih_reading">না</label>
                                                                </div>

                                                                <button type="submit" class="btn btn-primary">Update</button>

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