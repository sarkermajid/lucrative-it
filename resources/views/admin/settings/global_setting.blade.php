@extends('admin.layouts.app')
@section('content')

    <div id="main" role="main">
        <div id="ribbon">
				<span class="ribbon-button-alignment">
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
						<i class="fa fa-refresh"></i>
					</span>
				</span>
            <ol class="breadcrumb">
                <li>Home</li><li>Settings</li>
            </ol>
        </div>
        <div id="content">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                    <h1 class="page-title txt-color-blueDark">
                        <i class="fa fa-edit fa-fw "></i>
                        Global Setting<span>> Global Setting</span>
                    </h1>
                </div>
            </div>

            @if(Session::has('message'))
                <div class="allert-message alert-success-message pgray  alert-lg" role="alert">
                    <p> {{ Session::get('message') }}</p>
                </div>
            @endif

            <div class="row">
                <!-- NEW COL START -->
                <article class="col-md-9">
                    <div class="jarviswidget"  data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                            <h2>Update Global Setting </h2>
                        </header>
                        <div>

                            <div class="widget-body no-padding">
                                {!! Form::open(['url'=>__('global.apps_admin').'/global-setting','files'=>true,'class'=>'smart-form']) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset>
                                            <section>
                                                <label class="label">Company Name</label>
                                                <label class="input">
                                                    <input type="text" name="company_name" value="{{ $global_setting->company_name }}" placeholder="Enter Company Name" id="name" class="form-control" required>
                                                </label>
                                            </section>
                                            <section>
                                                <label class="label">Email</label>
                                                <label class="input">
                                                    <input type="email" name="email" value="{{ $global_setting->email }}" placeholder="Enter Email Address" id="email" class="form-control">
                                                </label>
                                            </section>
                                            <section>
                                                <label class="label">Phone</label>
                                                <label class="input">
                                                    <input type="text" name="phone" value="{{ $global_setting->phone }}" placeholder="Enter Phone" id="phone" class="form-control">
                                                </label>
                                            </section>
                                            <section>
                                                <label class="label">Address</label>
                                                <label class="input">
                                                    <input type="text" name="address" value="{{ $global_setting->address }}" placeholder="Enter Phone" id="phone" class="form-control">
                                                </label>
                                            </section>
                                            <section>
                                                <label class="label">Slogan</label>
                                                <label class="input">
                                                    <input type="text" name="slogan" value="{{ $global_setting->slogan }}" placeholder="Enter Phone" id="phone" class="form-control">
                                                </label>
                                            </section>
                                            <section>
                                                <label class="label">Facebook</label>
                                                <label class="input">
                                                    <input type="url" name="facebook" value="{{ $global_setting->facebook }}" placeholder="Enter Facebook" id="phone" class="form-control">
                                                </label>
                                            </section>
                                            <section>
                                                <label class="label">Twitter</label>
                                                <label class="input">
                                                    <input type="url" name="twitter" value="{{ $global_setting->twitter }}" placeholder="Enter Twitter" id="phone" class="form-control">
                                                </label>
                                            </section>
                                            <section>
                                                <label class="label">LinkedIn</label>
                                                <label class="input">
                                                    <input type="url" name="linkedin" value="{{ $global_setting->linkedin }}" placeholder="Enter LinkedIn" id="phone" class="form-control">
                                                </label>
                                            </section>
                                            <section>
                                                <label class="label">Instagram</label>
                                                <label class="input">
                                                    <input type="url" name="instagram" value="{{ $global_setting->instagram }}" placeholder="Enter Instagram" id="phone" class="form-control">
                                                </label>
                                            </section>
                                            <section>
                                                <label class="label">Header Script</label>
                                                <label class="textarea textarea-resizable">
                                                    <textarea name="header_script" rows="5"  placeholder="Enter Header Script">{!! $global_setting->header_script !!} </textarea>
                                                </label>
                                            </section>

                                            <section>
                                                <label class="label">Footer Script</label>
                                                <label class="textarea textarea-resizable">
                                                    <textarea name="footer_script" rows="5"  placeholder="Enter Footer Script">{!! $global_setting->footer_script !!}</textarea>
                                                </label>
                                            </section>

                                            {{--<section>
                                                <label class="label">Vat (%)</label>
                                                <label class="input">
                                                    <input type="text" name="vat" value="{{ $global_setting->vat }}" placeholder="Enter Vat" id="phone" class="form-control">
                                                </label>
                                            </section>
                                            <section>
                                                <label class="label">Invoice Prefix</label>
                                                <label class="input">
                                                    <input type="text" name="invoice_prefix" value="{{ $global_setting->invoice_prefix }}" placeholder="Enter Invoice Prefix" id="phone" class="form-control">
                                                </label>
                                            </section>
                                            <section>
                                                <label class="label">Purchase Prefix</label>
                                                <label class="input">
                                                    <input type="text" name="purchase_prefix" value="{{ $global_setting->purchase_prefix }}" placeholder="Enter Purchase Prefix" id="phone" class="form-control">
                                                </label>
                                            </section>
                                            <section>
                                                <label class="label">Print Header Footer Show</label>
                                                <div class="inline-group">
                                                    <label class="radio">
                                                        <input type="radio" name="header_show" value="Yes" @php echo ($global_setting->header_show=='Yes')?'checked':'' @endphp>
                                                        <i></i>Yes</label>
                                                    <label class="radio">
                                                        <input type="radio" value="No" name="header_show" @php echo ($global_setting->header_show=='No')?'checked':'' @endphp>
                                                        <i></i>No</label>
                                                </div>
                                            </section>--}}
                                            {{--<section>
                                                <label class="label">Vat Status</label>
                                                <label class="select">
                                                    {!! Form::select('is_vat', ['Yes' => 'Active', 'No' => 'InActive'], $global_setting->is_vat,['class'=>'form-control']) !!}<i></i>
                                                </label>
                                            </section>--}}
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="box">
                                            <div class="box-header with-border">
                                                <h3 class="box-title image-title text-center">Company Logo</h3>
                                            </div>
                                            <div class="box-body text-center">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 200px;">
                                                        <img src="@if($global_setting->company_logo != ''){{ asset($global_setting->company_logo) }} @else{{ 'http://placehold.it/200x200' }} @endif" width="100%" alt="...">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"></div>
                                                    <div class="">
                                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                                            <input name="company_logo" type="file" >
                                                        </span>
                                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="box">
                                            <div class="box-header with-border">
                                                <h3 class="box-title image-title text-center">Favicon</h3>
                                            </div>
                                            <div class="box-body text-center">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 200px;">
                                                        <img src="@if($global_setting->favicon != ''){{ asset($global_setting->favicon) }} @else{{ 'http://placehold.it/200x200' }} @endif" width="100%" alt="...">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"></div>
                                                    <div class="">
                                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                                            <input name="favicon" type="file" >
                                                        </span>
                                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <footer>
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                    <button type="button" class="btn btn-default" onclick="window.history.back();">
                                        Back
                                    </button>
                                </footer>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>



    </div>
@endsection

@section('js')



    <script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
    <script>
        $(function () {



        })
    </script>




@endsection