@extends('admin.layouts.app')

@section('content')
    <div id="main" role="main">

        <!-- RIBBON -->
        <div id="ribbon">
				<span class="ribbon-button-alignment">
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh" rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
						<i class="fa fa-refresh"></i>
					</span>
				</span>
                <ol class="breadcrumb">
                    <li>Home</li><li>System Settings</li>
                </ol>
        </div>
        <!-- END RIBBON -->

        <!-- MAIN CONTENT -->
        <div id="content">
            <h3>System Setting</h3>
            <hr/>
            @php  $tab = isset($_GET['tab'])?$_GET['tab']:'Basic' @endphp
            <div class="col-xs-3">
                <ul class="nav nav-tabs tabs-left">
                    <li class="@php echo ($tab=='Basic')?'active':'' @endphp"><a href="#basic" data-toggle="tab">Basic</a></li>
                    <li class="@php echo ($tab=='Contact')?'active':'' @endphp"><a href="#contact" data-toggle="tab">Contact</a></li>
                    <li class="@php echo ($tab=='Social')?'active':'' @endphp"><a href="#social" data-toggle="tab">Social</a></li>
                    <li class="@php echo ($tab=='Misc')?'active':'' @endphp"><a href="#misc" data-toggle="tab">Misc</a></li>
                    {{--<li class="@php echo ($tab=='Labels')?'active':'' @endphp"><a href="#labels" data-toggle="tab">Labels</a></li>--}}
                </ul>
            </div>
            <div class="col-xs-9">
                <!-- Tab panes -->
                {!! Form::open(['url'=>'admin/system-settings','files'=>true]) !!}
                <input type="hidden" name="tab" value="{{$tab}}">
                <div class="tab-content">
                                     {{--basic--}}
                    <div class="tab-pane @php echo ($tab=='Basic')?'active':'' @endphp" id="basic">
                        <div class="form-group">
                            <label>Site Title</label>
                            <input type="text" class="form-control" value="{{ settings('site_title', $settings) }}" name="data[site_title]">
                        </div>
                        <div class="form-group">
                            <label>Slogan</label>
                            <input type="text" class="form-control" value="{{ settings('site_slogan', $settings) }}" name="data[site_slogan]">
                        </div>


                        <div class="form-group">
                            <label>Favicon @if(settings('site_favicon', $settings)) <a href="#" data-toggle="modal" data-target="#FaviconModal">View Favicon</a> @endif</label>
                            <div class="input-group">
                                <input id="Favicon" readonly  type="text" class="form-control" value="{{ settings('site_favicon', $settings) }}" name="data[site_favicon]">
                                <a data-input="Favicon" class="lfm iframe-btn input-group-addon bg-success no-border"><i class="icon fa fa-upload"></i></a>
                                <a onclick="$(this).parent().find('#Favicon').val('');" href="javascript:" class="input-group-addon bg-danger no-border"><i class="icon fa fa-times-circle"></i></a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Logo @if(settings('site_logo', $settings)) <a href="#" data-toggle="modal" data-target="#LogoModal">View Logo</a> @endif</label>
                            <div class="input-group">
                                <input id="Logo" readonly type="text" class="form-control" value="{{ settings('site_logo', $settings) }}" name="data[site_logo]">
                                <a data-input="Logo" class="lfm iframe-btn input-group-addon bg-success no-border"><i class="icon fa fa-upload"></i></a>
                                <a onclick="$(this).parent().find('#Logo').val('');" href="javascript:" class="input-group-addon bg-danger no-border"><i class="icon fa fa-times-circle"></i></a>
                            </div>
                        </div>

                        {{--<div class="form-group">
                            <label>Header Logo 1 @if(settings('header_logo_1', $settings)) <a href="#" data-toggle="modal" data-target="#HeaderLogo1Modal">View Header Logo 1 </a> @endif</label>
                            <div class="input-group">
                                <input id="HeaderLogo1" readonly type="text" class="form-control" value="{{ settings('header_logo_1', $settings) }}" name="data[header_logo_1]">
                                <a data-input="HeaderLogo1" class="lfm iframe-btn input-group-addon bg-success no-border"><i class="icon fa fa-upload"></i></a>
                                <a onclick="$(this).parent().find('#HeaderLogo1').val('');" href="javascript:" class="input-group-addon bg-danger no-border"><i class="icon fa fa-times-circle"></i></a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Header Logo 2 @if(settings('header_logo_2', $settings)) <a href="#" data-toggle="modal" data-target="#HeaderLogo2Modal">View Header Logo 2</a> @endif</label>
                            <div class="input-group">
                                <input id="HeaderLogo2" readonly type="text" class="form-control" value="{{ settings('header_logo_2', $settings) }}" name="data[header_logo_2]">
                                <a data-input="HeaderLogo2" class="lfm iframe-btn input-group-addon bg-success no-border"><i class="icon fa fa-upload"></i></a>
                                <a onclick="$(this).parent().find('#HeaderLogo2').val('');" href="javascript:" class="input-group-addon bg-danger no-border"><i class="icon fa fa-times-circle"></i></a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Footer Logo 1 @if(settings('footer_logo_1', $settings)) <a href="#" data-toggle="modal" data-target="#FooterLogo1Modal">View Footer Logo 1 </a> @endif</label>
                            <div class="input-group">
                                <input id="FooterLogo1" readonly type="text" class="form-control" value="{{ settings('footer_logo_1', $settings) }}" name="data[footer_logo_1]">
                                <a data-input="FooterLogo1" class="lfm iframe-btn input-group-addon bg-success no-border"><i class="icon fa fa-upload"></i></a>
                                <a onclick="$(this).parent().find('#FooterLogo1').val('');" href="javascript:" class="input-group-addon bg-danger no-border"><i class="icon fa fa-times-circle"></i></a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Footer Logo 2 @if(settings('footer_logo_2', $settings)) <a href="#" data-toggle="modal" data-target="#HeaderLogo2Modal">View Header Logo 2</a> @endif</label>
                            <div class="input-group">
                                <input id="FooterLogo2" readonly type="text" class="form-control" value="{{ settings('footer_logo_2', $settings) }}" name="data[footer_logo_2]">
                                <a data-input="FooterLogo2" class="lfm iframe-btn input-group-addon bg-success no-border"><i class="icon fa fa-upload"></i></a>
                                <a onclick="$(this).parent().find('#FooterLogo2').val('');" href="javascript:" class="input-group-addon bg-danger no-border"><i class="icon fa fa-times-circle"></i></a>
                            </div>
                        </div>--}}

                    </div>

                                         {{--contact--}}
                    <div class="tab-pane @php echo ($tab=='Contact')?'active':'' @endphp" id="contact">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" class="form-control" value="{{ settings('site_phone', $settings) }}" name="data[site_phone]">
                        </div>

                        <div class="form-group">
                            <label>Phone 2</label>
                            <input type="number" class="form-control" value="{{ settings('site_phone2', $settings) }}" name="data[site_phone2]">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="{{ settings('site_email', $settings) }}" name="data[site_email]">
                        </div>

                        <div class="form-group">
                            <label>Email 2</label>
                            <input type="email" class="form-control" value="{{ settings('site_email2', $settings) }}" name="data[site_email2]">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" value="{{ settings('site_address', $settings) }}" name="data[site_address]">
                        </div>

                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="text" class="form-control" value="{{ settings('site_lat', $settings) }}" name="data[site_lat]">
                        </div>

                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="text" class="form-control" value="{{ settings('site_lon', $settings) }}" name="data[site_lon]">
                        </div>

                    </div>

                                       {{--social--}}
                    <div class="tab-pane @php echo ($tab=='Social')?'active':'' @endphp" id="social">
                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" class="form-control" value="{{ settings('facebook', $settings) }}" name="data[facebook]">
                        </div>
                        <div class="form-group">
                            <label>Twitter</label>
                            <input type="text" class="form-control" value="{{ settings('twitter', $settings) }}" name="data[twitter]">
                        </div>
                        {{--<div class="form-group">
                            <label>LinkedIn</label>
                            <input type="text" class="form-control" value="{{ settings('site_linkedin', $settings) }}" name="data[site_linkedin]">
                        </div>--}}
                        <div class="form-group">
                            <label>Google Plus</label>
                            <input type="text" class="form-control" value="{{ settings('google_plus', $settings) }}" name="data[google_plus]">
                        </div>
                        <div class="form-group">
                            <label>Youtube</label>
                            <input type="text" class="form-control" value="{{ settings('youtube', $settings) }}" name="data[youtube]">
                        </div>
                        {{--<div class="form-group">
                            <label>Instagram</label>
                            <input type="text" class="form-control" value="{{ settings('site_instagram', $settings) }}" name="data[site_instagram]">
                        </div>--}}
                        {{--<div class="form-group">
                            <label>Pinterest</label>
                            <input type="text" class="form-control" value="{{ settings('site_pinterest', $settings) }}" name="data[site_pinterest]">
                        </div>--}}
                    </div>


                                           {{--misc--}}
                    <div class="tab-pane @php echo ($tab=='Misc')?'active':'' @endphp" id="misc">
                        <div class="form-group">
                            <label>Term and Conditions link</label>
                            <input type="url" class="form-control" value="{{ settings('term_conditions', $settings) }}" name="data[term_conditions]">
                        </div>
                        <div class="form-group">
                            <label>Privacy and Policy Link</label>
                            <input type="url" class="form-control" value="{{ settings('privacy_policy', $settings) }}" name="data[privacy_policy]">
                        </div>
                    </div>
                                    {{--labels--}}{{--
                    <div class="tab-pane @php echo ($tab=='Labels')?'active':'' @endphp" id="labels">
                        <div class="form-group">
                            <label>Email Subscription</label>
                            <input type="text" class="form-control" value="{{ settings('email_subscription_title', $settings) }}" name="data[email_subscription_title]">
                        </div>
                        <div class="form-group">
                            <label>Email Subscription Sub Title</label>
                            <input type="text" class="form-control" value="{{ settings('email_subscription_subtitle', $settings) }}" name="data[email_subscription_subtitle]">
                        </div>
                    </div>--}}

                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="clearfix"></div>
            <br>

        </div>
        <!-- END MAIN CONTENT -->

    </div>



    <!-- Modal -->
                        {{--fevicon modal--}}
    <div id="FaviconModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Favicon Icom</h4>
                </div>
                <div class="modal-body">
                    <img src="{{ asset(settings('site_favicon', $settings)) }}" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    {{--logo modal--}}
    <div id="LogoModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Logo</h4>
                </div>
                <div class="modal-body">
                    <img src="{{ asset(settings('site_logo', $settings)) }}" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    {{--header logo 1 modal--}}
    <div id="HeaderLogo1Modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Header Logo 1</h4>
                </div>
                <div class="modal-body">
                    <img src="{{ asset(settings('header_logo_1', $settings)) }}" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    {{--header logo 2 modal--}}
    <div id="HeaderLogo2Modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Header Logo 2</h4>
                </div>
                <div class="modal-body">
                    <img src="{{ asset(settings('header_logo_2', $settings)) }}" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    {{--header logo 1 modal--}}
    <div id="FooterLogo1Modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Footer Logo 1</h4>
                </div>
                <div class="modal-body">
                    <img src="{{ asset(settings('footer_logo_1', $settings)) }}" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    {{--header logo 2 modal--}}
    <div id="FooterLogo2Modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Footer Logo 2</h4>
                </div>
                <div class="modal-body">
                    <img src="{{ asset(settings('footer_logo_2', $settings)) }}" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>



@endsection

@section('js')


    <!--<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> -->

    <script src="{{ asset('js/libs/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script type="text/javascript">

        // DO NOT REMOVE : GLOBAL FUNCTIONS!

        $(document).ready(function() {

            $('.tabs-left a').click(function(){
               var tabtext = $(this).text();
               $('[name="tab"]').val(tabtext);
            })


            $.fn.filemanager = function(type, options) {
                type = type || 'file';

                this.on('click', function(e) {
                    var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                    localStorage.setItem('target_input', $(this).data('input'));
                    localStorage.setItem('target_preview', $(this).data('preview'));
                    window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
                    window.SetUrl = function (url, file_path) {
                        //set the value of the desired input to image url
                        var target_input = $('#' + localStorage.getItem('target_input'));
                        target_input.val(file_path).trigger('change');

                    };
                    return false;
                });
            }
            $('.lfm').filemanager('image');


            $('#timepicker').timepicker();
            $('#timepicker1').timepicker();

            $(".datepicker").datepicker({
                changeMonth: true,
                numberOfMonths: 1,
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                dateFormat: 'yy-mm-dd',

            });



        })

    </script>


@endsection