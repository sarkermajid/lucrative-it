@extends('layouts.app_cv')
@section('content')
	<div class="main-container">
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

						<div class="btn-groupbtn-group tab-group" role="group" aria-label="...">
							<FORM action="LinkSubmit.asp" method="post" name="formPS_View" id="formPS_View">
								<button type="button" onclick="location.href='{{ url('resume-view-step1') }}'" class="btn btn-tab-personal"><i class="fa fa-user"></i>&nbsp;Personal</button>
								<button type="button" onclick="location.href='{{ url('resume-view-step2') }}'" onclick=javascript:PassUserID('Education'); class="btn btn-tab-education"  ><i class="fa fa-graduation-cap"></i>&nbsp;Education/Training</button>
								<button type="button" onclick="location.href='{{ url('resume-view-step3') }}'" class="btn active btn-tab-personal"getAddform onclick=javascript:PassUserID('Employment'); class="btn btn-tab-employment"><i class="fa fa-briefcase"></i>&nbsp;Employment</button>
								<button type="button" onclick="location.href='{{ url('resume-view-step4') }}'" onclick=javascript:PassUserID('Others'); class="btn btn-tab-others"><i class="fa fa-list"></i>&nbsp;Other Information</button>
								<button type="button" onclick="location.href='{{ url('resume-view-step5') }}'" onclick=javascript:PassUserID('Photograph'); class="btn btn-tab-photograph"><i class="fa fa-camera"></i>&nbsp;Photograph</button>

							</FORM>
						</div>





						<div class="confirmation-message">
							<!--<button type="button" class="close"><span aria-hidden="true" >×</span></button>-->
							<span id="c_msg"></span>
						</div>
						<div class="server-error">
							<!--<button type="button" class="close"><span aria-hidden="true" >×</span></button>-->
							<span id="c_msg"></span>
						</div>



						<div id="msgDiv">
						</div>
						<div class="loader">
                        </div>
						<div style="" class="panel-group resume-panel-group personal" id="accordion3" role="tablist" aria-multiselectable="true">

							<div class="panel">
								<div class="panel-heading" role="tab" id="headingOne">
									<h4 class="panel-title">
										<a role="button" class="" data-toggle="collapse" data-parent="#accordion3" href="#employmentOne" aria-expanded="true" aria-controls="employmentOne">
											Employment History&nbsp;<i class="indicator icon-minus"></i>
										</a>
									</h4>
								</div>
								<div id="employmentOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
									<div class="panel-body">
										<div id="commonForm_exp">

											@foreach($exp_infos as $key=>$exp_info)
											<div id="commonForm_exp_{{ $key }}" >
												<div class='all-info exp_{{ $key }}' id="exp_{{ $key }}">
													<div class='sub-header'>
														<h4>Experience {{ $key+1 }}</h4>
														<div class='edit-tools'>
															<button class='btn edit-btn'><i class='icon-pencil-o'></i>&nbsp;Edit</button>
															<button class="btn exp-delete delete-btn" value="{{$exp_info->id}}"><i class='icon-trush-can'></i>&nbsp;Delete</button>
														</div>
													</div>
													{!! Form::open(['url'=>'exp-edit-submit','files'=>true,'class'=>'row view-mode formSubmit','id'=>'expForm'.$key]) !!}
													<input type="hidden" value="{{ $exp_info->id }}" name="id">
														<div id='alertDiv_exp'>
														</div>
														<div class='col-md-6'>
															<div class='row'>
																<div class='form-group col-md-12'>
																	<label for=''>Company Name&nbsp;<abbr title='Required' value="" class='required'></abbr></label>
																	<input type='text' class='form-control' placeholder='' value='{{ $exp_info->company_name }}' name='company_name' id='txtCompany'>
																</div>
																<div class='form-group col-md-12'>
																	<label for=''>Company Business&nbsp;<abbr title='Required' class='required'></abbr></label>
																	<input type='text' class='form-control autosuggest ui-autocomplete-input' placeholder='' value='{{ $exp_info->company_business }}' id='cboBusiness_0' name='company_business'>
																</div>
																<div class='form-group col-md-12'>
																	<label for=''>Designation&nbsp;<abbr title='Required' class='required'></abbr></label>
																	<input type='text' class='form-control' placeholder='' value='{{ $exp_info->designation }}' name='designation' id='txtEPosition'>
																</div>
																<div class='form-group col-md-12'>
																	<label for=''>Department&nbsp;</label>
																	<input type='text' class='form-control' placeholder='' value='{{ $exp_info->department }}'  name='department' id='txtDept'>
																</div>
																<div class='form-group col-md-12'>
																	<label for=''>Area of Experiences:&nbsp;<abbr title='Required' class='required'></abbr></label>
																	<div class='' id='prefOrgDiv'>
																		<span class='input-note m-b-10 btn-form-control hidden'>Add your expertise skill (max 3)</span>
																		<div id='lstJobArea' >
																			<div class='selected-location'>
																				<input type='text' id='txtExpArea' name='experiences_area' value="{{ $exp_info->experiences_area }}" class='autosuggest txt-add-location ui-autocomplete-input btn-form-control hidden form-control'>
																			</div>
																		</div>
																	</div>
																</div>

															</div>
														</div>
														<div class='col-md-6'>
															<div class='row'>
																<div class='form-group col-md-12'>
																	<label for=''>Responsibilities&nbsp;</label>
																	<div class='onclick-hidden textarea-texts'>{{ $exp_info->responsibilities }}</div>
																	<textarea id='txtDuty' name='responsibilities' cols='30' rows='4' class='form-control btn-form-control hidden'>{{ $exp_info->responsibilities }}</textarea>
																</div>
																<div class='form-group col-md-12'>
																	<label for=''>Company Location</label>
																	<input type='text' class='form-control' placeholder='' value='{{ $exp_info->company_location }}' name='company_location' id='txtCLocation'>
																</div>
																<div class='form-group col-md-12' style='margin:0;'>
																	<label for=''>Employment Period&nbsp;<abbr title='Required' class='required'></abbr></label>
																</div>

																<div class='form-group col-md-6'>
																	<input type='text' class='form-control datepicker btn-form-control fromDate hidden' placeholder='From' value='{{ $exp_info->start_date }}' id='cboFromDate' name='start_date'>
																</div>
																<div class='form-group col-md-6'>
																	<input type='text' class='form-control datepicker btn-form-control toDate hidden' placeholder='To' value='{{ $exp_info->end_date }}' id='cboTODate' name='end_date' >
																</div>
																<div class='form-group col-md-12 btn-form-control hidden'><label class='checkbox-inline'>
																		<input  type='checkbox' name='currently_working' id='chkContinue' value='Yes' >{{ ($exp_info->currently_working=='Yes')?'Currently Working':'' }}</label>
																</div>
															</div>
														</div>
														<input type='hidden' name='userType' id='userType' value=>
														<div class='col-md-12 btn-form-control hidden'>
															<button type="submit" class="btn btn-primary">Save</button>
															<a href='employment.html'  class='btn btn-cancel'>Close</a>
														</div>
													{!! Form::close() !!}
												</div>
											</div>
											@endforeach


											<div class="empty-message m-t-40" id="noData_exp" style="display:none">
												<i class="icon icon-briefcase"></i>

												<p>
													Currently no data exist! Please click on the following <br />button to add your employment information.
												</p>
												<!-- <button class="btn btn-gray m-t-10"><i class="icon-plus"></i>&nbsp;Add Training</button>-->
											</div>


										</div>

										<div id="div_exp"></div>
										<div class='text-center'>
											<button class="btn btn-gray m-t-10" id="btnAdd_exp" onclick="getAddform('exp');" ><i class="icon-plus"></i>&nbsp;Add Experience (If Required) </button>
										</div>
									</div>
								</div>
							</div>

						</div>
                    </div>
					<!-- end army-->
				</div>
			</div><!-- another common div -->
		</div><!-- another common div -->
	</div><!-- another common div -->
	</div>
@endsection


@section('js')


	<script type="text/javascript" src="https://mybdjobs.bdjobs.com/js/new_js/edit-resume.js"></script>

	<script type="text/javascript">

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
                    $('#'+id).find('.btn-form-control').addClass('hidden');;


                }
            });
        });




        $('.exp-delete').on('click',function(e){
            if (confirm('Are you sure you want to delete this record ?')) {
                var id = $(this).parents('div.all-info').attr('id');
                var exp_id = $(this).attr('value');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:"POST",
                    url: '/employment-delete',
                    data:{id:exp_id},
                    dataType: 'html',
                    success: function(data){
                        $('#'+id).hide();
                    },

                })
            }
        });



        function getAddform(type)
        {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '/exp-form',
                dataType: 'HTML',
                data: {division_id: ''},
                success: function( msg ) {
                    $('#div_exp').html(msg);
                }
            });

        }
	</script>



        
@endsection










