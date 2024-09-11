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
								<button type="button" onclick="location.href='{{ url('resume-view-step1') }}'" onclick=javascript:PassUserID('Personal'); class="btn  btn-tab-personal"><i class="fa fa-user"></i>&nbsp;Personal</button>
								<button type="button" onclick="location.href='{{ url('resume-view-step2') }}'" onclick=javascript:PassUserID('Education'); class="btn active btn-tab-education"  ><i class="fa fa-graduation-cap"></i>&nbsp;Education/Training</button>
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


						<!-- Tab panes -->
						<div class="loader"></div>

						<div class="panel-group resume-panel-group education" id="accordion2" role="tablist" aria-multiselectable="true">
							<!-- academic qualification-->
							<div class="panel">
								<div class="panel-heading" role="tab" id="headingOne">
									<h4 class="panel-title">
										<a role="button" class="" data-toggle="collapse" data-parent="#accordion2" href="#educationOne" aria-expanded="true" aria-controls="educationOne">
											Academic Summary&nbsp;<i class="indicator icon-minus"></i>
										</a>
									</h4>
								</div>
								<div id="educationOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
									<div class="panel-body">
										<div id="commonForm_aca">
											@foreach($aca_info as $key=>$aca)

											<div id="commonForm_aca_{{ $key }}" >

												<div class='all-info aca_{{ $key }}' id="aca_{{ $key }}">
													<div class='sub-header'>
														<h4>Academic {{ $key+1 }} </h4>
														<div class='edit-tools'>
															<button class='btn edit-btn'><i class='icon-pencil-o'></i>&nbsp;Edit</button>
															<button class="btn aca-delete delete-btn" value="{{ $aca->id }}"><i class='icon-trush-can'></i>&nbsp;Delete</button>
														</div>
													</div>
													<div id='alertDiv_aca'>

													</div>
													{!! Form::open(['url'=>'aca-edit-submit','files'=>true,'class'=>'row view-mode formSubmit','id'=>'acaForm'.$key]) !!}
													<input type="hidden" value="{{ $aca->id }}" name="id">
														<div class='col-md-6'>
															<div class='row'>
																<div class='form-group col-md-12'>
																	<label for=''>Level of Education&nbsp;<abbr title='Required' class='required'></abbr></label>
																	<select required='required' class='form-control' name='education_level' id='cboEduLevel0'>
																		<option value='PSC/5 pass'>PSC/5 pass</option>
																		<option value='JSC/JDC/8 pass'>JSC/JDC/8 pass</option>
																		<option value='Secondary'>Secondary</option>
																		<option value='Higher Secondary' Selected>Higher Secondary</option>
																		<option value='Diploma'>Diploma</option>
																		<option value='Bachelor/Honors'>Bachelor/Honors</option>
																		<option value='Masters'>Masters</option>
																		<option value='PhD (Doctor of Philosophy)'>PhD (Doctor of Philosophy)</option>
																	</select>
																</div>


																<div class='form-group col-md-12'>
																	<label for=''>Concentration/ Major/Group&nbsp;<abbr title='Required' class='required'></abbr></label>
																	<input type='text' id='txtMajorGroup0' name='concentration' class='form-control' placeholder='' value='{{ $aca->concentration }}'>
																</div>

																<div class='form-group col-md-12' id='showBoard'style='display:block;'>
																	<label for=''>Board&nbsp;<abbr title='Required' class='required'></abbr></label>
																	<select class='form-control' name='board' id='txtExamBoard'0 >
																		<option value=''>Select</option>
																		<option value='Barishal'>Barishal</option>
																		<option value='Chattogram'>Chattogram</option>
																		<option value='Cumilla'>Cumilla</option>
																		<option value='Dhaka' Selected>Dhaka</option>
																		<option value='Dinajpur'>Dinajpur</option>
																		<option value='Jashore'>Jashore</option>
																		<option value='Rajshahi'>Rajshahi</option>
																		<option value='Sylhet'>Sylhet</option>
																		<option value='Madrasah'>Madrasah</option>
																		<option value='Technical'>Technical</option>
																	</select>
																</div>
																<div class='form-group col-md-12'>
																	<label for=''>Institute Name&nbsp;<abbr title='Required' class='required'></abbr></label>
																	<textarea class='onclick-hidden form-control' name='instute_name' id='' cols='30'>{{ $aca->instute_name }} </textarea>
																</div>
															</div>
														</div>
														<div class='col-md-6'>
															<div class='row'>
																<div class='form-group col-md-12'>
                                                                    <label for=''>Result&nbsp;<abbr title='Required' class='required'></abbr></label>
                                                                    <input type='text' class='form-control' placeholder='' value='{{ $aca->result }}' name='result'>
																</div>

                                                                <div class='form-group col-md-12'>
                                                                    <label for='' id='yrsOfPass'> <span>Year of Passing</span>&nbsp;<abbr title='Required' class='required'></abbr></label>
                                                                    <select class='form-control' name='passing_year' id='cboPassingYear'>
                                                                        <option value='-1'>Year</option><option value='2024'>2024</option><option value='2023'>2023</option><option value='2022'>2022</option><option value='2021'>2021</option><option value='2020'>2020</option><option value='2019'>2019</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011' Selected>2011</option><option value='2010'>2010</option><option value='2009'>2009</option><option value='2008'>2008</option><option value='2007'>2007</option><option value='2006'>2006</option><option value='2005'>2005</option><option value='2004'>2004</option><option value='2003'>2003</option><option value='2002'>2002</option><option value='2001'>2001</option><option value='2000'>2000</option><option value='1999'>1999</option><option value='1998'>1998</option><option value='1997'>1997</option><option value='1996'>1996</option><option value='1995'>1995</option><option value='1994'>1994</option><option value='1993'>1993</option><option value='1992'>1992</option><option value='1991'>1991</option><option value='1990'>1990</option><option value='1989'>1989</option><option value='1988'>1988</option><option value='1987'>1987</option><option value='1986'>1986</option><option value='1985'>1985</option><option value='1984'>1984</option><option value='1983'>1983</option><option value='1982'>1982</option><option value='1981'>1981</option><option value='1980'>1980</option>
																		<option value='1979'>1979</option>
																		<option value='1978'>1978</option>
																		<option value='1977'>1977</option>
																		<option value='1976'>1976</option>
																		<option value='1975'>1975</option>
																		<option value='1974'>1974</option>
																		<option value='1973'>1973</option>
																		<option value='1972'>1972</option>
																		<option value='1971'>1971</option>
																		<option value='1970'>1970</option>
																		<option value='1969'>1969</option>
																		<option value='1968'>1968</option>
																		<option value='1967'>1967</option>
																		<option value='1966'>1966</option>
																		<option value='1965'>1965</option>
																		<option value='1964'>1964</option>
																	</select>
																</div>
																<div class='form-group col-md-12'>
																	<label for=''>Duration&nbsp;<small>(Years)</small></label>
																	<input type='text' class='form-control' placeholder='' value='{{ $aca->duration }}' name='duration'>
																</div>
															</div>
														</div>
														<div class='form-group col-md-12'>
															<label for=''>Achievement</label>
															<input type='text' class='form-control' placeholder='' value='{{ $aca->achievement }}' name='achievement'>
														</div>
														<div class='col-md-12 btn-form-control hidden'>
															<button type="submit" class="btn btn-primary">Save</button>
															<a class='btn btn-cancel' href='education.html'>Close</a>
														</div>
													{!! Form::close() !!}
												</div>
											</div>
											@endforeach

											<div class="empty-message m-t-40" id="noData_aca" style="display:block">
												<i class="fa fa-graduation-cap"></i>
												<p>
													Currently no data exist! Please click on the following <br />button to add your academic qualification .
												</p>
											</div>
										</div>
										<div id="div_aca">
										</div>
										<div class='text-center'>
											<button class="btn btn-gray m-t-10" id="btnAdd_aca" onclick="getAddform('aca');" ><i class="icon-plus"></i>&nbsp;Add Education (If Required)</button>
										</div>
									</div>
								</div>
							</div>

							<!-- end academic qualification -->


							<!-- training -->
							<div class="panel">
								<div class="panel-heading" role="tab" id="headingTwo">
									<h4 class="panel-title">
										<a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#educationTwo" aria-expanded="true" aria-controls="educationTwo">
											Training Summary&nbsp;<i class="indicator icon-plus"></i>
										</a>
									</h4>
								</div>
								<div id="educationTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
									<div class="panel-body">

										<div id="commonForm_tr">
											@foreach($tr_info as $key=>$tr)
											<div id="commonForm_tr_{{ $key }}" >
												<div class='all-info tr_{{ $key }}' id="tr_{{ $key }}">
													<div class='sub-header'>
														<h4>Training {{ $key+1 }}</h4>
														<div class='edit-tools'>
															<button class='btn edit-btn'><i class='icon-pencil-o'></i>&nbsp;Edit</button>
															<button class="btn tr-delete delete-btn" value="{{ $tr->id }}"><i class='icon-trush-can'></i>&nbsp;Delete</button>
														</div>
													</div>
													<div id='alertDiv_tr'>

													</div>
													{!! Form::open(['url'=>'tr-edit-submit','files'=>true,'class'=>'row view-mode formSubmit','id'=>'pqForm'.$key]) !!}
													<input type="hidden" value="{{ $tr->id }}" name="id">
														<div class='form-group col-md-6'>
															<label for=''>Training Title&nbsp;<abbr title='Required' class='required'></abbr></label>
															<input type='text' class='form-control mandatory jqValidate_tr' id='100' placeholder='' name='training_title' value='{{ $tr->training_title }}'>
															<input type='hidden' class='form-control' placeholder='' name='txtT_ID' value='eV7Et7b8819913lPRGYF54'>
															<input type='hidden' class='form-control' placeholder='' id='trItemNo' name='txtTrItemNo' value='0'>
														</div>
														<div class='form-group col-md-6'>
															<label for=''>Country&nbsp;<abbr title='Required' class='required'></abbr></label>
															<input type='text' class='form-control mandatory jqValidate_tr' id='50' placeholder='' name='country' value='{{ $tr->country }}'>
														</div>
														<div class='form-group col-md-6'>
															<label for=''>Topics Covered</label>
                                                            <input type='text' class='form-control jqValidate_tr txtTopic' id='300' placeholder='' name='topics_covered' value='{{ $tr->topics_covered }}'>
														</div>
														<div class='form-group col-md-6'>
															<label for=''>Training Year&nbsp;<abbr title='Required' class='required'></abbr></label>
                                                            <select class='form-control mandatory jqValidate_tr' name='training_year' id=''>
                                                                <option value='' selected='selected'>Select</option><option value='2024'>2024</option>
                                                                <option value='2023'>2023</option><option value='2022'>2022</option><option value='2021'>2021</option><option value='2020'>2020</option><option value='2019'>2019</option><option value='2018' Selected>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option><option value='2010'>2010</option><option value='2009'>2009</option><option value='2008'>2008</option><option value='2007'>2007</option><option value='2006'>2006</option><option value='2005'>2005</option><option value='2004'>2004</option><option value='2003'>2003</option><option value='2002'>2002</option><option value='2001'>2001</option><option value='2000'>2000</option><option value='1999'>1999</option><option value='1998'>1998</option><option value='1997'>1997</option><option value='1996'>1996</option><option value='1995'>1995</option><option value='1994'>1994</option><option value='1993'>1993</option><option value='1992'>1992</option><option value='1991'>1991</option><option value='1990'>1990</option><option value='1989'>1989</option><option value='1988'>1988</option><option value='1987'>1987</option><option value='1986'>1986</option><option value='1985'>1985</option><option value='1984'>1984</option><option value='1983'>1983</option><option value='1982'>1982</option><option value='1981'>1981</option><option value='1980'>1980</option><option value='1979'>1979</option><option value='1978'>1978</option><option value='1977'>1977</option><option value='1976'>1976</option><option value='1975'>1975</option><option value='1974'>1974</option><option value='1973'>1973</option><option value='1972'>1972</option><option value='1971'>1971</option><option value='1970'>1970</option><option value='1969'>1969</option><option value='1968'>1968</option><option value='1967'>1967</option><option value='1966'>1966</option><option value='1965'>1965</option><option value='1964'>1964</option>
                                                            </select>
														</div>
														<div class='form-group col-md-6'>
															<label for=''>Institute&nbsp;<abbr title='Required' class='required'></abbr></label>
															<input type='text' class='form-control mandatory jqValidate_tr' id='80' placeholder='' name='institute' value='imrpur academy'>
														</div>
														<div class='form-group col-md-6'><label for=''>Duration&nbsp&nbsp;<abbr title='Required' class='required'></abbr></label>
															<input type='text' class='form-control mandatory jqValidate_tr' placeholder='' id='10' name='duration' value='{{ $tr->duration }}'>
                                                            <input type='hidden' name='isBlueColor' id='isBlueColor' value='False'>
														</div>
														<div class='form-group col-md-6'><label for=''>Location</label>
															<input type='text' class='form-control jqValidate_tr' id='50' placeholder='' name='location' value='{{ $tr->location }}'>
														</div>
														<div class='col-md-12 btn-form-control hidden'>
															<button type="submit" class="btn btn-primary">Save</button>
															<a href='education.html' class='btn btn-cancel'>Close</a>
														</div>
													{!! Form::close() !!}
												</div>
											</div>
											@endforeach


											<div class="empty-message m-t-40" id="noData_tr" style="display:block">
												<i class="icon icon-graduation-cap"></i>
												<p>
													Currently no data exist! Please click on the following <br />button to add your training information.
												</p>

											</div>


										</div>
										<!-- If no information found then show this message -->
										<div id="div_tr">

										</div>
										<div class='text-center'>
											<!--<button class="btn btn-gray m-t-10" id="btnAdd_tr" onclick="addCommonForm('tr');"><i class="icon-plus"></i>&nbsp;Add Training</button>-->
											<button class="btn btn-gray m-t-10" id="btnAdd_tr" onclick="getAddform('tr');" ><i class="icon-plus"></i>&nbsp;Add Training (If Required)</button>
										</div>
									</div>
								</div>
							</div>
							<!-- end training-->
							<!-- professional qualification -->
							<div class="panel">
								<div class="panel-heading" role="tab" id="headingThree">
									<h4 class="panel-title">
										<a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#educationThree" aria-expanded="true" aria-controls="educationThree">
											Professional Certification Summary&nbsp;<i class="indicator icon-plus"></i>
										</a>
									</h4>
								</div>
								<div id="educationThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" style="height: auto;">

									<p id="global_error_message_container" class="message_container">

										<span id="global_error_message"></span>
									</p>
									<div class="panel-body">
										<div id="commonForm_pq">
											@foreach($pq_info as $key=>$pq)
											<div id="commonForm_pq_{{ $key }}">
												<div class='all-info pq_{{ $key }}' id="pq_{{ $key }}">
													<div class='sub-header'>
														<h4>Professional Qualification {{ $key+1 }}</h4>
														<div class='edit-tools'>
															<button class='btn edit-btn' id='0'><i class='icon-pencil-o'></i>&nbsp;Edit</button>
															<button class="btn pq-delete delete-btn" value="{{$pq->id}}"><i class='icon-trush-can'></i>&nbsp;Delete</button>
														</div>
													</div>
													<div id='alertDiv_pq'>

													</div>
													{!! Form::open(['url'=>'pq-edit-submit','files'=>true,'class'=>'row view-mode formSubmit','id'=>'pqForm'.$key]) !!}
													<input type="hidden" value="{{ $pq->id }}" name="id">
														<div class='col-md-9 col-xs-9'>
															<input type='hidden' name='txtPQ_Code' id='pQ_Code'value='xM1d4cu512759It665245'>
															<input type='hidden' id='pqItemNo'  name='txtPqItemNo' value='0'>
														</div>
														<div class='col-md-6'>
															<div class='row'>
																<div class='form-group col-md-12'>
																	<label for=''>Certification&nbsp;<abbr title='Required' class='required'></abbr></label>
																	<input type='text' class='form-control mandatory jqValidate_pq_0' id='80' name='certification' placeholder='' value='{{ $pq->certification }}'>
																</div>
																<div class='form-group col-md-12'>
																	<label for=''>Institute&nbsp;<abbr title='Required' class='required'></abbr></label>
																	<input type='text' name='institute' class='form-control mandatory jqValidate_pq_0' id='80' placeholder='' value='{{ $pq->institute }}'>
																</div>
															</div>
														</div>
														<div class='col-md-6'>
															<div class='row'>
																<div class='form-group col-md-12'>
																	<label for=''>Location</label>
																	<input type='text' name='location' class='form-control jqValidate_pq_0' id='50' placeholder='' value='{{ $pq->location }}'>
																</div>
																<div class='form-group col-md-12' style='margin:0;'><label for=''>Certification Period&nbsp;<abbr title='Required' class='required'></abbr></label>
																</div>
																<div class='form-group col-md-12' style='margin: 0;'>
																	<div class='onclick-hidden date-range'>
																		<input type='text' class='form-control'  value='4/8/2019'><span>To</span>
																		<input type='text' class='form-control'  value='4/12/2019'>
																	</div>
																</div>
																<div class='form-group col-md-6'>
																	<input type='text' name='calFromDate' class='form-control btn-form-control  hidden mandatory jqValidate_pq_0 datepicker fromDate' id='1000' placeholder='From'  value='4/8/2019'>
																</div>
																<div class='form-group col-md-6'>
																	<input type='text' name='calToDate' class='form-control btn-form-control  hidden mandatory jqValidate_pq_0 datepicker toDate greater' id='1000' placeholder='To'  value='4/12/2019'>
																</div>
															</div>
														</div>
														<input type='hidden' name='hCurrentDate' id ='hCurrentDate' value='4/22/2019'>
														<div class='col-md-12 btn-form-control hidden'>
															<button type="submit" class="btn btn-primary">Save</button>
															<a href='education.html' class='btn btn-cancel'>Close</a>
														</div>
													{!! Form::close() !!}
												</div>
											</div>
											@endforeach

											<div class="empty-message m-t-40" id="noData_pq" style="display:block">
												<i class="icon icon-graduation-cap"></i>
												<p>Currently no data exist! Please click on the following button to add your professional qualification.</p>
											</div>
										</div>

										<div id="div_pq">

										</div>
										<div class='text-center'>
											<button class="btn btn-gray m-t-10" id="btnAdd_pq"   onclick="getAddform('pq');"><i class="icon-plus"></i>&nbsp;Add Professional Qualification </button>
										</div>
									</div>
								</div>
							</div>
							<!-- end professional qualification -->

						</div>
					</div>
				</div>
			</div>
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




        $('.aca-delete').on('click',function(e){
            if (confirm('Are you sure you want to delete this record ?')) {
                var id = $(this).parents('div.all-info').attr('id');
                var aca_id = $(this).attr('value');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:"POST",
                    url: '/aca-delete',
                    data:{id:aca_id},
                    dataType: 'html',
                    success: function(data){
                        $('#'+id).hide();
                    },

                })
            }
        });

        $('.tr-delete').on('click',function(e){
            if (confirm('Are you sure you want to delete this record ?')) {
                var id = $(this).parents('div.all-info').attr('id');
                var tr_id = $(this).attr('value');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:"POST",
                    url: '/tr-delete',
                    data:{id:tr_id},
                    dataType: 'html',
                    success: function(data){
                        $('#'+id).hide();
                    },

                })
            }
        });

        $('.pq-delete').on('click',function(e){
            if (confirm('Are you sure you want to delete this record ?')) {
                var id = $(this).parents('div.all-info').attr('id');
                var pq_id = $(this).attr('value');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:"POST",
                    url: '/pq-delete',
                    data:{id:pq_id},
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









