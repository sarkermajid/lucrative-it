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
				<div class="modal fade" id="myModal" role="dialog" style="display:none; height:400px; width:400px;">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Updated Successfully</h4>
							</div>
							<div class="modal-body">
								<p id="F_U_message">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-3">

				</div>


				<div class="col-md-9 content">

					<div class="big-card">

						<div class="btn-group tab-group" role="group" aria-label="...">
							<FORM action="LinkSubmit.asp" method="post" name="formPS_View" id="formPS_View">
								<input name="hPS" type="hidden" id="hPS" value="false"/>


								<button type="button" onclick="location.href='{{ url('resume-view-step1') }}'" class="btn btn-tab-personal"><i class="fa fa-user"></i>&nbsp;Personal</button>
								<button type="button" onclick="location.href='{{ url('resume-view-step2') }}'" onclick=javascript:PassUserID('Education'); class="btn btn-tab-education"  ><i class="fa fa-graduation-cap"></i>&nbsp;Education/Training</button>
								<button type="button" onclick="location.href='{{ url('resume-view-step3') }}'" onclick=javascript:PassUserID('Employment'); class="btn btn-tab-employment"><i class="fa fa-briefcase"></i>&nbsp;Employment</button>
								<button type="button" onclick="location.href='{{ url('resume-view-step4') }}'" onclick=javascript:PassUserID('Others'); class="btn btn-tab-others"><i class="fa fa-list"></i>&nbsp;Other Information</button>
								<button type="button" onclick="location.href='{{ url('resume-view-step5') }}'" class="btn active btn-tab-personal" onclick=javascript:PassUserID('Photograph'); class="btn btn-tab-photograph"><i class="fa fa-camera"></i>&nbsp;Photograph</button>

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



						<div class="loader"></div>
						<div class="panel-group resume-panel-group photograph" id="accordion5" role="tablist" aria-multiselectable="true">
							<div class="panel">
								<div id="collapseOne2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
									<div class="panel-body">
										<!-- If no information found then show this message -->
										<div class="all-info">
											<div class="empty-message m-t-20 photo-upload">
												{!! Form::open(['url'=>'resume-view-step5-edit-submit','files'=>true,'class'=>'']) !!}

													{{--<div id="noData"  style="display: inline;" >
														<p>You don't have any photo, Please upload photo </p>
													</div>--}}

												    <input type="hidden" value="{{ $basic_info->id }}" name="id">
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-new thumbnail" style="">
															<img src="@php echo ($basic_info->photograph)?url('images/'.$basic_info->photograph):'http://placehold.it/200x200' @endphp" width="200px" alt="...">
														</div>
														<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
														<div>
															<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
																<input name="photograph" accept="image/*" type="file" >
															</span>
															<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
														</div>
													</div>

													<div>
														<button class="btn btn-primary btn-upload" id="uploadPhoto" type="submit"><i class="icon-upload">&nbsp;</i>Upload Photo</button>
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
		</div>
	</div>
@endsection

@section('js')
<script src="{{ asset('assets/cv/js/jasny-bootstrap.min.js') }}"></script>
@endsection









