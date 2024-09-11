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

						<div class="btn-group tab-group" role="group" aria-label="...">
							<FORM action="LinkSubmit.asp" method="post" name="formPS_View" id="formPS_View">
								<input name="hPS" type="hidden" id="hPS" value="false"/>


								<button type="button" onclick="location.href='{{ url('resume-view-step1') }}'" class="btn btn-tab-personal"><i class="fa fa-user"></i>Personal</button>
								<button type="button" onclick="location.href='{{ url('resume-view-step2') }}'" onclick=javascript:PassUserID('Education'); class="btn btn-tab-education"  ><i class="fa fa-graduation-cap"></i>&nbsp;Education/Training</button>
								<button type="button" onclick="location.href='{{ url('resume-view-step3') }}'" onclick=javascript:PassUserID('Employment'); class="btn btn-tab-employment"><i class="fa fa-briefcase"></i>&nbsp;Employment</button>
								<button type="button" onclick="location.href='{{ url('resume-view-step4') }}'" class="btn active btn-tab-personal" onclick=javascript:PassUserID('Others'); class="btn btn-tab-others"><i class="fa fa-list"></i>&nbsp;Other Information</button>
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
						<div class="loader"></div>
						<div class="panel-group resume-panel-group others" id="accordion4" role="tablist" aria-multiselectable="true">
							{{--<div class="panel">
								<div class="panel-heading" role="tab" id="headingOne">
									<h4 class="panel-title">
										<a role="button" class="" data-toggle="collapse" data-parent="#accordion4" href="#othersOne" aria-expanded="true" aria-controls="othersOne">
											Specialization&nbsp;<i class="indicator icon-minus"></i>
										</a>
									</h4>
								</div>
								<div id="othersOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
									<div class="panel-body" id="panelBody_spe">
										<div id="commonForm_spe">
											<div id="commonForm_spe_0">

											</div>

											<div class="empty-message m-t-40" id="noData_spe"  style="display:block";>
												<i class="icon icon-ribbon"></i>

												<p>Currently no data exist! Please click on the following button to add your specialization and extra curricular activities.</p>
											</div>
										</div>

										<div id="div_spe">

										</div>
										<div class='text-center'>
											<button class="btn btn-gray m-t-10" id="btnAdd_spe" onclick="getAddform('spe');" ><i class="icon-plus"></i>&nbsp;Add specialization</button>
										</div>




									</div>
								</div>
							</div>--}}<!--  end Specialization -->
							<!--------------------------------------language -------------------------------------->
							<div class="panel">
								<div class="panel-heading" role="tab" id="headingTwo">
									<h4 class="panel-title">
										<a role="button" class="collapsed"  data-toggle="collapse" data-parent="#accordion4" href="#othersTwo" aria-expanded="true" aria-controls="othersTwo">Language Proficiency&nbsp;<i class="indicator icon-plus"></i>
										</a>
									</h4>
								</div>
								<div id="othersTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
									<div class="panel-body">
										<div id="commonForm_lan">
											@foreach($lan_infos as $key=>$lan_info)
											<div class='all-info lan_{{ $key }}' id="lan_{{ $key }}">
												<div class='sub-header'>
													<h4>Language </h4>
													<div class='edit-tools'>
														<button class='btn edit-btn'><i class='icon-pencil-o'></i>&nbsp;Edit</button>
														<button class='btn lan-delete delete-btn' value="{{$lan_info->id}}"><i class='icon-trush-can'></i>&nbsp;Delete</button>
													</div>
												</div>
												<div id='alertDiv_lan'>

												</div>
												{!! Form::open(['url'=>'lan-edit-submit','files'=>true,'class'=>'row view-mode formSubmit','id'=>'lanForm'.$key]) !!}
												<input type="hidden" value="{{ $lan_info->id }}" name="id">
													<div class='form-group col-md-6'>
														<label for=''>Language<abbr title='Required' class='required'></abbr></label>
														<input type='text' required class='form-control mandatory jqValidate_lan' id='50' name='language' placeholder='' value='{{ $lan_info->language }}'>
														<input type='hidden' value='-1' name='txtLanguageID' />
														<input type='hidden' class='form-control' placeholder='' id='lanItemNo' name='txtLanItemNo' value=''>
													</div>
													<div class='form-group col-md-6'>
														<label for=''>Reading&nbsp;<abbr title='Required' class='required'></abbr></label>
														<select class='form-control mandatory jqValidate_lan' name='reading' id='10'>
															<option value='Select'>Select</option>
															<option {{ ($lan_info->reading=='High')?'selected':'' }} value='High'>High</option>
															<option {{ ($lan_info->reading=='Medium')?'selected':'' }} value='Medium'>Medium</option>
															<option {{ ($lan_info->reading=='Low')?'selected':'' }} value='Low'>Low</option>
														</select>
													</div>
													<div class='form-group col-md-6'>
														<label for=''>Writing&nbsp;<abbr title='Required' class='required'></abbr></label>
														<select class='form-control mandatory  jqValidate_lan' name='writing' id='10'>
															<option value='Select'>Select</option>
															<option {{ ($lan_info->writing=='High')?'selected':'' }} value='High'>High</option>
															<option {{ ($lan_info->writing=='Medium')?'selected':'' }} value='Medium'>Medium</option>
															<option {{ ($lan_info->writing=='Low')?'selected':'' }} value='Low'>Low</option>
														</select>
													</div>
													<div class='form-group col-md-6'>
														<label for=''>Speaking&nbsp;<abbr title='Required' class='required'></abbr></label>
														<select class='form-control mandatory  jqValidate_lan' name='speaking' id='10'>
															<option value='Select'>Select</option>
															<option {{ ($lan_info->speaking=='High')?'selected':'' }} value='High'>High</option>
															<option {{ ($lan_info->speaking=='Medium')?'selected':'' }} value='Medium'>Medium</option>
															<option {{ ($lan_info->speaking=='Low')?'selected':'' }} value='Low'>Low</option>
														</select>
													</div>
													<div class='col-md-12 btn-form-control hidden'>
														<button type="submit" class="btn btn-primary">Save</button>
														<a href=javascript:void(0); onClick=closeDiv('lan'); class='btn btn-cancel'>Close</a>
													</div>
												{!! Form::close() !!}
											</div>
											@endforeach

											<div class="empty-message m-t-40" id="noData_lan" style="display:block">
												<i class="icon icon-language"></i>
												<p>Currently no data exist! Please click on the following button to add your language proficiency.</p>
											</div>
										</div>
										<div id="div_lan">
										</div>

										<div>
											<button class="btn btn-gray  m-t-10" id="btnAdd_lan" onclick="getAddform('lan');" style="display:block"><i class="icon-plus"></i>&nbsp;Add Language</button>
										</div>

									</div>
								</div>
							</div>
							<!----------------------------------------------------referrence-------------------------------->
							<div class="panel">
								<div class="panel-heading" role="tab" id="headingOne">
									<h4 class="panel-title">
										<a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion4" href="#othersThree" aria-expanded="true" aria-controls="othersThree">References&nbsp;<i class="indicator icon-plus"></i>
										</a>
									</h4>
								</div>
								<div id="othersThree" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
									<p id="global_error_message_container" class="message_container">

										<span id="global_error_message"></span>
									</p>
									<div class="panel-body">
										<div id="commonForm_ref">
											@foreach($ref_infos as $key=>$ref_info)
											<div class='all-info ref_{{ $key }}' id="ref_{{ $key }}">
												<div class='sub-header'>
													<h4>Reference </h4>
													<div class='edit-tools' style='display:block'>
														<button class='btn edit-btn'><i class='icon-pencil-o'></i>&nbsp;Edit</button>
														<button class='btn ref-delete delete-btn' value="{{$ref_info->id}}"><i class='icon-trush-can'></i>&nbsp;Delete</button>
													</div>
												</div>
												<div id='alertDiv_ref' >

												</div>

												{!! Form::open(['url'=>'ref-edit-submit','files'=>true,'class'=>'row view-mode formSubmit','id'=>'refForm'.$key]) !!}
												<input type="hidden" value="{{ $ref_info->id }}" name="id">
													<div class='col-md-9 col-xs-9'>
														<input type='hidden' name='hR_Code' id='hR_Code' value='-1'/>
														<input type='hidden' id='refItemNo' name='txtRefItemNo' value=''/>
													</div>
													<div class='col-md-6'>
														<div class='row'>
															<div class='form-group col-md-12'>
																<label for=''>Name&nbsp;<abbr title='Required' class='required'></abbr></label>
																<input type='text' name='name' id='50' class='form-control mandatory jqValidate_ref' placeholder='' value='{{ $ref_info->name }}'>
															</div>
															<div class='form-group col-md-12'>
																<label for=''>Designation&nbsp;<abbr title='Required' class='required'></abbr></label>
																<input type='text' name='designation' id='50' class='form-control mandatory jqValidate_ref' placeholder='' value='{{ $ref_info->designation }}'>
															</div>
															<div class='form-group col-md-12'>
																<label for=''>Mobile&nbsp;</label>
																<input type='text' name='mobile' id='50' class='form-control jqValidate_ref' placeholder='' value='{{ $ref_info->mobile }}'>
															</div>
															<div class='form-group col-md-12'>
																<label for=''>Email&nbsp;</label>
																<input type='text' name='email' id='50' class='form-control jqValidate_ref' placeholder='' value='{{ $ref_info->email }}'>
															</div>
															<div class='form-group col-md-12'>
																<label for=''>Relation&nbsp;</label>
																<select class='form-control jqValidate_ref' name='relation' id='cboRRelation1'>
																	<option {{ ($ref_info->relation=='Relative')?'selected':'' }} value='Relative'>Relative</option>
																	<option {{ ($ref_info->relation=='Family Friend')?'selected':'' }} value='Family Friend'>Family Friend</option>
																	<option {{ ($ref_info->relation=='Academic')?'selected':'' }} value='Academic'>Academic</option>
																	<option {{ ($ref_info->relation=='Professional')?'selected':'' }} value='Professional'>Professional</option>
																	<option {{ ($ref_info->relation=='Others')?'selected':'' }} value='Others'>Others</option>
																</select>
															</div>
														</div>
													</div>
													<div class='col-md-6'>
														<div class='row'>
															<div class='form-group col-md-12'>
																<label for=''>Organization&nbsp;<abbr title='Required' class='required'></abbr></label>
																<input type='text' name='organization' id='50' class='form-control mandatory jqValidate_ref' placeholder='' value='{{ $ref_info->organization }}'>
															</div>
															<div class='form-group col-md-12'>
																<label for=''>Phone (Off)&nbsp;</label><input type='text' name='phone_off' id='50' class='form-control jqValidate_ref' placeholder='' value='{{ $ref_info->phone_off }}'>
															</div>
															<div class='form-group col-md-12'>
																<label for=''>Phone (Res)&nbsp;</label>
																<input type='text' name='phone_res' id='50' class='form-control jqValidate_ref' placeholder='' value='{{ $ref_info->phone_res }}'>
																<input type='hidden' name='isBlueColor' id='isBlueColor' value='False'>
															</div>
															<div class='form-group col-md-12'>
																<label for=''>Address</label>
																<textarea name='address' id='250' cols='30' rows='3' class='form-control jqValidate_ref_'>{{ $ref_info->address }}</textarea>
															</div>
														</div>
													</div>
													<div class='col-md-12 btn-form-control hidden'>
														<button type="submit" class="btn btn-primary">Save</button>
														<a href='javascript:void(0)' onClick=closeDiv('ref')  class='btn btn-cancel'>Close</a>
													</div>
												{!! Form::close() !!}
											</div>
											@endforeach

											<div class="empty-message m-t-40" id="noData_ref" style="display:block">
												<i class="icon icon-career"></i>
												<p>Currently no data exist! Please click on the following button to add your reference.</p>
											</div>

										</div>
										<div id="div_ref">
										</div>


										<div>
											<button  id="btnAdd_ref" class="btn btn-gray  m-t-10" onclick="getAddform('ref');" style="display:block"><i class="icon-plus"></i>&nbsp;Add Reference
											</button>
										</div>
									</div>
								</div>
							</div>

						</div><!-- end accordion -->
					</div><!-- another common div -->
				</div><!-- another common div -->
			</div><!-- another common div -->
		</div>
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




        $('.lan-delete').on('click',function(e){
            if (confirm('Are you sure you want to delete this record ?')) {
                var id = $(this).parents('div.all-info').attr('id');
                var lan_id = $(this).attr('value');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:"POST",
                    url: '/lan-delete',
                    data:{id:lan_id},
                    dataType: 'html',
                    success: function(data){
                        $('#'+id).hide();
                    },

                })
            }
        });

        $('.ref-delete').on('click',function(e){
            if (confirm('Are you sure you want to delete this record ?')) {
                var id = $(this).parents('div.all-info').attr('id');
                var ref_id = $(this).attr('value');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:"POST",
                    url: '/ref-delete',
                    data:{id:ref_id},
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
                url: '/cv-form',
                dataType: 'HTML',
                data: {type: type},
                success: function( msg ) {
                    $('#div_'+type).html(msg);
                }
            });
        }




	</script>


@endsection





