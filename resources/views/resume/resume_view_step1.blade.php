@extends('layouts.app_cv')
@section('content')
	<div class="leftsidebar">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="{{ url('/') }}">Home</a></li>
				<li class="active">My Profile</li>
			</ul>
			<div class="row">
				<div class="col-md-3 sidebar">
					@include('layouts.profile_left')
				</div>


				<div class="col-md-9 content">

					<div class="big-card">
						<div class="btn-group tab-group" role="group" aria-label="...">
							<FORM action="LinkSubmit.asp" method="post" name="formPS_View" id="formPS_View">
								<input name="hPS" type="hidden" id="hPS" value="false"/>
								<button type="button" onclick="location.href='{{ url('resume-view-step1') }}'" onclick=javascript:PassUserID('Education');  class="btn active btn-tab-personal"><i class="fa fa-user"></i>&nbsp;Personal</button>
								<button type="button" onclick="location.href='{{ url('resume-view-step2') }}'"  class="btn btn-tab-education"  ><i class="fa fa-graduation-cap"></i>&nbsp;Education/Training</button>
								<button type="button" onclick="location.href='{{ url('resume-view-step3') }}'" onclick=javascript:PassUserID('Employment'); class="btn btn-tab-employment"><i class="fa fa-briefcase"></i>&nbsp;Employment</button>
								<button type="button" onclick="location.href='{{ url('resume-view-step4') }}'" onclick=javascript:PassUserID('Others'); class="btn btn-tab-others"><i class="fa fa-list"></i>&nbsp;Other Information</button>
								<button type="button" onclick="location.href='{{ url('resume-view-step5') }}'" onclick=javascript:PassUserID('Photograph'); class="btn btn-tab-photograph"><i class="fa fa-camera"></i>&nbsp;Photograph</button>
							</FORM>
						</div>

						<div class="confirmation-message">
							<span id="c_msg"></span>
						</div>
						<div class="server-error">
							<span id="c_msg"></span>
						</div>

						<div class="loader"></div>

						<div style="" class="panel-group resume-panel-group personal" id="accordion" role="tablist" aria-multiselectable="true">
							<div class="panel">
								<div class="panel-heading" role="tab" id="headingOne">
									<h4 class="panel-title">
										<a role="button" class="" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											Personal Details&nbsp;<i class="indicator icon-minus"></i>
										</a>
									</h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
									<div class="panel-body">
										<div class="all-info per_0" id="per_0">
											<div class="sub-header">
												<div class="edit-tools">
													<button class="btn edit-btn"><i class="icon-pencil-o"></i>&nbsp;Edit</button>
												</div>
											</div>
											<div id="alertDiv_per"></div>
											{!! Form::open(['url'=>'personal-form-edit-submit','files'=>true,'class'=>'row view-mode formSubmit']) !!}
											<input type="hidden" value="{{ $basic_info->id }}" name="id">
											<div class="col-md-6">
												<div class="row">
													<div class="form-group col-md-12">
														<label for="">First Name&nbsp;<abbr title="Required" class="required"></abbr></label>
														<input type="text" class="form-control" placeholder="" value="{{ $basic_info->first_name }}" required name="first_name" id="txtFirstName">
													</div>
													<div class="form-group col-md-12">
														<label for="">Last Name</label>
														<input type="text" class="form-control" placeholder="" value="{{ $basic_info->last_name }}" required name="last_name" id="txtLastName">
													</div>
													<div class="form-group col-md-12">
														<label for="">Father's Name</label>
														<input type="text" class="form-control" placeholder="" value="{{ $basic_info->father_name }}" name="father_name" id="txtFName">
													</div>
													<div class="form-group col-md-12">
														<label for="">Mother's Name</label>
														<input type="text" class="form-control" placeholder="" value="{{ $basic_info->mother_name }}" required name="mother_name" id="txtMName">
													</div>
													<div class="form-group col-md-12">
														<label for="">Date of Birth&nbsp;<abbr title="Required" class="required"></abbr></label>
														<input type="text" class="form-control datepicker" placeholder="" value="{{ $basic_info->dob }}" name="dob" id="txtBirthDate">
													</div>
													<div class="form-group col-md-12">
														<label for="">Gender&nbsp;<abbr title="Required" class="required"></abbr></label>
														<select name="gender" required  id="cboGender" class="form-control">
															<option value="" selected>Select</option>
															<option value="Male" {{ ($basic_info->gender=='Male')?'selected':'' }}>Male</option>
															<option value="Female" {{ ($basic_info->gender=='Female')?'selected':'' }}>Female</option>
															<option value="Others" {{ ($basic_info->gender=='Others')?'selected':'' }} >Others</option>
														</select>
													</div>
													<div class="form-group col-md-12">
														<label for="">Religion</label>
														<input type="text" class="form-control" placeholder="" value="{{ $basic_info->religion }}" name="religion" id="txtReligion">
													</div>
													<div class="form-group col-md-12">
														<label for="">Marital Status&nbsp;<abbr title="Required" class="required"></abbr></label>
														<select name="mstatus" id="cboMStatus" class="form-control">
															<option value="">Select</option>
															<option value="Unmarried" {{ ($basic_info->mstatus=='Unmarried')?'selected':'' }}>Unmarried</option>
															<option value="Married" {{ ($basic_info->mstatus=='Married')?'selected':'' }} > Married </option>
															<option value="Single" {{ ($basic_info->mstatus=='Others')?'selected':'' }}> Single </option>
														</select>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="row">
													<div class="form-group col-md-12">
														<div class="title-wrap">
															<label for="">Nationality&nbsp;<abbr title="Required" class="required"></abbr></label>
															<input class="form-control" name="nationality" id="nViewFild" placeholder="" value="{{ $basic_info->nationality }}" type="text">
														</div>
													</div>

													<div class="form-group col-md-12">
														<label for="">National Id No</label>
														<input type="text" class="form-control" required placeholder="" value="{{ $basic_info->national_id }}" name="national_id" id="txtNationalId">
													</div>

													<div class="form-group col-md-12">
														<label for="">Passport Number</label>
														<input type="text" class="form-control" placeholder="" value="{{ $basic_info->passport_no }}" name="passport_no"  id="passportNo">
													</div>

													<div class="form-group col-md-12">
														<label for="">Passport Issue Date</label>
														<input type="text" class="form-control datepicker" placeholder="" value="{{ $basic_info->passport_issue_date }}" name="passport_issue_date" id="issueDate">
													</div>

													<div class="form-group col-md-12">
														<label for="" class="sui">Mobile No (Home)</label>
														<input type="text" class="form-control" placeholder="" value="{{ $basic_info->phone_h }}" name="phone_h" id="txtMobile" >
													</div>

													<div class="form-group col-md-12">
														<label for="">Mobile No 2</label>
														<input type="text" class="form-control" placeholder="" value="{{ $basic_info->phone_off }}" name="phone_off" id="txtPhone_H">
													</div>

													<div class="form-group col-md-12">
														<label for="" class="sui">Email</label>
														<input type="text" class="form-control" placeholder="" value="{{ $basic_info->email }}" name="txtEmail1" id="txtEmail1" readonly>
													</div>
													<div class="form-group col-md-12">
														<label for="">Alternate Email</label>
														<input type="text" class="form-control" placeholder="" value="{{ $basic_info->email2 }}" name="email2"  id="txtEmail2">
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="btn-form-control hidden">
													<button type="submit" class="btn btn-primary">Save</button>
													<a href="{{ url('resume-view-step1') }}" class="btn btn-default btn-cancel reset">Close</a>
												</div>
											</div>
											{!! Form::close() !!}
										</div>
									</div>
								</div><!-- end of collapseOne div-->
							</div><!-- end of personal details panel-->
							<!--start details address-->

							<div class="panel">
								<div class="panel-heading" role="tab" id="headingTwo">
									<h4 class="panel-title">
										<!-- do in bangla -->
										<a class="collapsed " role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
											Address Details<i class="indicator icon-plus"></i>
										</a>
									</h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
									<div class="panel-body">
										<div class="all-info adrs_0" id="adrs_0" style='display:block;'>
											<div class="sub-header">
												<div id="alertDiv_adrs"></div>
												<div class="edit-tools">
													<button class="btn edit-btn" id="addressEditBtn"><i class="icon-pencil-o"></i>&nbsp;Edit</button>
												</div>
											</div>
											{!! Form::open(['url'=>'address-form-edit-submit','files'=>true,'class'=>'row view-mode formSubmit','id'=>'addressForm']) !!}
											<input type="hidden" value="{{ $basic_info->id }}" name="id">
											<div class="col-md-6">
												<div class="address-wrap">


													<div class="title-wrap">
														<label for="permanentAddress">Present Address</label>
													</div>

													<div class="form-group btn-form-control">
														<input type="text" class="form-control" id="present_Village" name="present_add" value="{{ $basic_info->present_add }}" placeholder="Type your House No / Road / Village">
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="address-wrap permanent-address">
													<div class="title-wrap">
														<label for="permanentAddress">Permanent Address</label>
													</div>
													<div class="disable-area disable">
														<div class="form-group">
															<input type="text" class="form-control" id="present_Village" name="permanent_add" value="{{ $basic_info->permanent_add }}" placeholder="Type your House No / Road / Village">
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="btn-form-control hidden">
													<button type="submit" class="btn btn-primary">Save</button>
													<a href="{{ url('resume-view-step1') }}" class="btn btn-default btn-cancel reset">Close</a>
												</div>
											</div>
											{!! Form::close() !!}
										</div>

									</div>
								</div>
							</div>

							<!--end details address-->
							<!-- start career application information -->
							<div class="panel">
								<div class="panel-heading" role="tab" id="headingThree">
									<h4 class="panel-title">
										<a class="collapsed " role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
											Career and Application Information&nbsp;<i class="indicator icon-plus"></i>
										</a>
									</h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
									<div class="panel-body">
										<div class="all-info cai_0" id="cai_0">
											<div class="sub-header">
												<div id="alertDiv_cai"></div>
												<div class="edit-tools">
													<button class="btn edit-btn"><i class="icon-pencil-o"></i>&nbsp;Edit</button>
												</div>
											</div>
											{!! Form::open(['url'=>'cai-form-edit-submit','files'=>true,'class'=>'row view-mode formSubmit']) !!}
											<input type="hidden" value="{{ $basic_info->id }}" name="id">
											<div class="col-md-12 form-group">
												<label for="">Objective&nbsp;</label>
												<textarea name="objective" id="txtObjective" cols="10" rows="3" class="form-control">{{ $basic_info->objective }}</textarea>
											</div>

											<div class="col-md-6 form-group">
												<label for="">Present Salary</label>
												<input type="text" class="form-control" placeholder="" value="{{ $basic_info->present_salary }}" name="present_salary" id="txtPresentSalary" maxlength="10">
												<span class="input-note btn-form-control hidden">TK/ Month</span>
											</div>

											<div class="col-md-6 form-group">
												<label for="">Expected Salary</label>
												<input type="text" class="form-control" placeholder="" value="{{ $basic_info->expected_salary }}" name="expected_salary" id="txtExpectedSalary" maxlength="10">
												<span class="input-note btn-form-control hidden">TK/ Month</span>
											</div>

											<div class="col-md-6 form-group">
												<label for="">Looking for (Job Level)</label>
												<input class="form-control onclick-hidden" placeholder="" id="lookForView" value="" type="text">
												<div class="btn-form-control hidden">
													<label class="radio-inline">
														<input type="radio" name="job_level" id="levelRadio" value="Entry" > Entry Level
													</label>
													<label class="radio-inline">
														<input type="radio" name="job_level" id="levelRadio" value="Mid" > Mid Level
													</label>
													<label class="radio-inline">
														<input type="radio" name="job_level" id="levelRadio" value="Top" > Top Level
													</label>
												</div>
											</div>

											<div class="col-md-6 form-group">
												<label for="">Available for (Job Nature)</label>
												<input class="form-control onclick-hidden" placeholder="" value="" type="text" id="availView">
												<div class="btn-form-control hidden">
													<label class="radio-inline">
														<input type="radio" name="job_nature" id="avaiRadio" value="Full Time" > Full time
													</label>
													<label class="radio-inline">
														<input type="radio" name="job_nature" id="avaiRadio" value="Part Time" > Part time
													</label>
													<label class="radio-inline">
														<input type="radio" name="job_nature" id="avaiRadio" value="Contract" > Contract
													</label>
												</div>
											</div>

											<div class="col-md-12">
												<div class="btn-form-control hidden">
													<button type="submit" class="btn btn-primary">Save</button>
													<a href="{{ url('resume-view-step1') }}" class="btn btn-default btn-cancel reset">Close</a>
												</div>
											</div>
											{!! Form::close() !!}
										</div>

									</div>
								</div>
							</div>

						</div> <!-- end of accordion div -->
					</div><!-- another common div -->
				</div><!-- another common div -->
			</div><!-- another common div -->
		</div><!-- another common div -->
	</div>
	</div>
	</div>
	</div>

@endsection

@section('js')



	<script>

        $(document).ready(function() {

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



            $(document).on("click", ".edit-tools .edit-btn", function(){
                $(this).parents('div.all-info').find('.edit-tools').hide();
                $(this).parents('div.all-info').find('.btn-form-control').removeClass('hidden');
                $(this).parents('div.all-info').find('.form-group').find('.onclick-hidden').addClass('yes');
                $(this).parents('div.all-info').find('.btn-form-control .btn').show();
            });



            $(document).on("click", ".tab-group .btn", function(){
                $(this).parents('div.tab-group').find('.btn').removeClass('active');
                $(this).addClass('active');
            });
            function toggleIcon(e) {
                $(e.target)
                    .prev('.panel-heading')
                    .find(".indicator")
                    .toggleClass('icon-minus icon-plus');
            }
            $('.panel-group').on('hidden.bs.collapse', toggleIcon).css('color','#000');
            $('.panel-group').on('shown.bs.collapse', toggleIcon);

            // EDIT RESUME TAB
            $(document).on("click", ".btn-tab-personal", function(){
                $(this).parents('div.big-card').find('.resume-panel-group').hide();
                $('.resume-panel-group.personal').removeClass('hidden');
                $('.resume-panel-group.personal').show();
                // $('.loader').fadeIn();
            });
            $(document).on("click", ".btn-tab-education", function(){
                $(this).parents('div.big-card').find('.resume-panel-group').hide();
                $('.resume-panel-group.education').removeClass('hidden');
                $('.resume-panel-group.education').show();
            });
            $(document).on("click", ".btn-tab-employment", function(){
                $(this).parents('div.big-card').find('.resume-panel-group').hide();
                $('.resume-panel-group.employment').removeClass('hidden');
                $('.resume-panel-group.employment').show();
            });
            $(document).on("click", ".btn-tab-others", function(){
                $(this).parents('div.big-card').find('.resume-panel-group').hide();
                $('.resume-panel-group.others').removeClass('hidden');
                $('.resume-panel-group.others').show();
            });
            $(document).on("click", ".btn-tab-photograph", function(){
                $(this).parents('div.big-card').find('.resume-panel-group').hide();
                $('.resume-panel-group.photograph').removeClass('hidden');
                $('.resume-panel-group.photograph').show();
            });


            // Nationality
            $(document).on("click", ".onclick", function(){
                $(this).parents('div.btn-form-control').find('.onclick-show').removeClass('hidden');
            });
            $(document).on("click", ".onclick-o", function(){
                $(this).parents('div.btn-form-control').find('.onclick-show').addClass('hidden');
            });



            $(document).on("mouseover", ".chips-container a", function(){
                $(this).parents('div.chips-container .well').addClass('hover');
            });
            $(document).on("mouseout", ".chips-container a", function(){
                $(this).parents('div.chips-container .well').removeClass('hover');
            });


            // Wells onclick hide
            $(document).on("click", ".chips-container a.dismiss", function(){
                $(this).parents('div.well').fadeOut();
            });

            $(document).on("click", ".edit-tools .edit-btn", function(){
                $(this).parents('div.all-info').find('form').removeClass('view-mode');
            });

            $(document).ready(function(){
                $('[data-toggle="popover"]').popover();
            });


            // GOOD AND ORDINARY EXAMPLE
            $(document).on("click", ".edit-tools .edit-btn", function(){
                $(this).parents('div.all-info').find('form').removeClass('view-mode');
            });

            // PHOTO UPLOAD EDIT RESUME
            $(function () {
                $(":file").change(function () {
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded;
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            });

            function imageIsLoaded(e) {
                $('#userImg').attr('src', e.target.result);
            };


            $(function(){
                $('.has-spinner').click(function() {
                    $(this).toggleClass('active');
                });
            });

            // UPLOADING
            $(document).on("click", ".btn-upload", function(){
                $(this).find('i.icon-upload').removeClass('icon-upload').addClass('spin icon-circle-loader');
                $(this).addClass('uploading');
            });
            $(document).on("click", ".tab-group .btn", function(){
                $(this).parents('div.big-card').find('.loader').show();
                $(this).find('.panel');
            });
            // $('.alert.alert-dismissible').fadeIn('fast').delay(2000).fadeOut('slow');
            // Applied globally on all textareas with the "autoExpand" class
            $(document).one('focus.autoExpand', 'textarea.autoExpand', function(){
                var savedValue = this.value;
                this.value = '';
                this.baseScrollHeight = this.scrollHeight;
                this.value = savedValue;
            })
                .on('input.autoExpand', 'textarea.autoExpand', function(){
                    var minRows = this.getAttribute('data-min-rows')|0, rows;
                    this.rows = minRows;
                    rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 17);
                    this.rows = minRows + rows;
                });
        });


        $("body").on("submit", "form.formSubmit", function (e) {
            e.preventDefault();

            var id = $(this).parents('div.all-info').attr('id');


            var form = $(this);
            var formdata = false;
            if (window.FormData) {
                formdata = new FormData(form[0]);
            }

            var formAction = form.attr('action');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: formAction,
                type: 'POST',
                data: formdata,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data, textStatus, jqXHR) {

                    $('#'+id).find('form').addClass('view-mode');
                    $('#'+id).find('.edit-tools').show();
                    $('#'+id).find('.btn-form-control .btn').hide();

                    /*$('form').hide('slow');
                    $('.staff-delete').hide('slow')
                    $('.modalhide').show();*/

                    //datatables.ajax.reload();

                    /*  var timesRun = 0;
                      var interval = setInterval(function () {
                          timesRun += 1;
                          if (timesRun === 1) {
                              clearInterval(interval);
                          }
                          $('.modal').modal('hide');

                      }, 10);*/

                }
            });
        });







	</script>








@endsection









