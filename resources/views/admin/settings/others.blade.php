@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div id="main" role="main">
        <!-- Content Header (Page header) -->
        <div id="ribbon">
				<span class="ribbon-button-alignment">
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
						<i class="fa fa-refresh"></i>
					</span>
				</span>
            <ol class="breadcrumb">
                <li>Home</li><li>Others Settings</li>
            </ol>
        </div>
        <div id="content">
            <!-- Main content -->
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                    <h1 class="page-title txt-color-blueDark">
                        <i class="fa fa-edit fa-fw "></i>
                        Settings
                        <span>>
								Others Settings
							</span>
                    </h1>
                </div>

            </div>

            <section class="content">
                @if(Session::has('message'))
                    <div class="allert-message alert-success-message pgray  alert-lg" role="alert">
                        <p> {{ Session::get('message') }}</p>
                    </div>
                @endif


                    <div class="row">
                        <div class="col-xs-4">
                            {!! Form::open(['url'=>'others','files'=>true]) !!}
                            <div class="box">
                                <!-- form start -->
                                <div class="box-body">
                                    <div class="form-group field_wrapper">
                                        <label for="name">Product Units</label>
                                        @if($product_unit->count())
                                            @foreach($product_unit as $key=>$row)
                                                <div class="row fields">
                                                    <div class="col-md-6">
                                                        <input type="text" required class="form-control" value="{{$row->name}}" name="name[]"/>
                                                    </div>
                                                    @if(!$key)
                                                        <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus"></i></a>
                                                    @else
                                                        <a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus"></i></a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row fields">
                                                <div class="col-md-6">
                                                    <input type="text" required class="form-control" value="" name="name[]"/>
                                                </div>
                                                <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus"></i></a>

                                            </div>
                                        @endif
                                    </div>
                                    <button class="btn btn-primary" name="product_unit" value="Update"  type="submit">Update</button>
                                </div>
                            {!! Form::close() !!}
                            </div>
                        </div>

                       {{--<div class="col-xs-4">
                            {!! Form::open(['url'=>'expense','files'=>true]) !!}
                            <div class="box">
                                <div class="box-body">
                                    <div class="form-group field_wrapper2">
                                        <label for="name">Utility Titles</label>
                                        @if($utility_title->count())
                                            @foreach($utility_title as $key=>$row)
                                                <div class="row fields2">
                                                    <div class="col-md-8">
                                                        <input type="text" required class="form-control" value="{{$row->title}}" name="title[]"/>
                                                    </div>
                                                    @if(!$key)
                                                        <a href="javascript:void(0);" class="add_button2" title="Add field"><i class="fa fa-plus"></i></a>
                                                    @else
                                                        <a href="javascript:void(0);" class="remove_button2" title="Remove field"><i class="fa fa-minus"></i></a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row fields2">
                                                <div class="col-md-8">
                                                    <input type="text" required class="form-control" value="" name="title[]"/>
                                                </div>
                                                <a href="javascript:void(0);" class="add_button2" title="Add field"><i class="fa fa-plus"></i></a>
                                            </div>

                                        @endif

                                    </div>
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>--}}

                       {{-- <div class="col-xs-4">
                            {!! Form::open(['url'=>'expense','files'=>true]) !!}
                            <div class="box">
                                <div class="box-body">
                                    <div class="form-group field_wrapper3">
                                        <label for="name">Teams</label>
                                        @if($team->count())
                                            @foreach($team as $key=>$row)
                                                <div class="row fields3">
                                                    <div class="col-md-8">
                                                        <input type="text" required class="form-control" value="{{$row->team}}" name="team[]"/>
                                                    </div>
                                                    @if(!$key)
                                                        <a href="javascript:void(0);" class="add_button3" title="Add field"><i class="fa fa-plus"></i></a>
                                                    @else
                                                        <a href="javascript:void(0);" class="remove_button3" title="Remove field"><i class="fa fa-minus"></i></a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row fields2">
                                                <div class="col-md-8">
                                                    <input type="text" required class="form-control" value="" name="team[]"/>
                                                </div>
                                                <a href="javascript:void(0);" class="add_button3" title="Add field"><i class="fa fa-plus"></i></a>
                                            </div>

                                        @endif

                                    </div>
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>--}}
                    </div>







                <!-- ./row -->
            </section>
        <!-- /.content -->
        </div>
    </div>
@endsection

@section('js')


    <script>
        $(function () {
                               /*more field for bazar unit*/

            var maxField = 100; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div  class="row fields"> <div class="col-md-6">\n' +
                '                                            <input type="text" required class="form-control" name="name[]" value=""/>\n' +
                '                                        </div><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus"></i></a></div>'; //New input field html
            var x = 1; //Initial field counter is 1
            $(addButton).click(function(){ //Once add button is clicked
                if(x < maxField){ //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); // Add field html
                }
            });
            $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });




            /*more field for utility title*/

            var maxField2 = 100; //Input fields increment limitation
            var addButton2 = $('.add_button2'); //Add button selector
            var wrapper2 = $('.field_wrapper2'); //Input field wrapper
            var fieldHTML2 = '<div  class="row fields2"> <div class="col-md-8">\n' +
                '                                            <input type="text" required class="form-control" name="title[]" value=""/>\n' +
                '                                        </div><a href="javascript:void(0);" class="remove_button2" title="Remove field"><i class="fa fa-minus"></i></a></div>'; //New input field html
            var x = 1; //Initial field counter is 1
            $(addButton2).click(function(){ //Once add button is clicked
                if(x < maxField2){ //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper2).append(fieldHTML2); // Add field html
                }
            });
            $(wrapper2).on('click', '.remove_button2', function(e){ //Once remove button is clicked
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });

                               /*more field for team*/

            var maxField3 = 100; //Input fields increment limitation
            var addButton3 = $('.add_button3'); //Add button selector
            var wrapper3 = $('.field_wrapper3'); //Input field wrapper
            var fieldHTML3 = '<div  class="row fields3"> <div class="col-md-8">\n' +
                '                                            <input type="text" required class="form-control" name="team[]" value=""/>\n' +
                '                                        </div><a href="javascript:void(0);" class="remove_button3" title="Remove field"><i class="fa fa-minus"></i></a></div>'; //New input field html
            var x = 1; //Initial field counter is 1
            $(addButton3).click(function(){ //Once add button is clicked
                if(x < maxField3){ //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper3).append(fieldHTML3); // Add field html
                }
            });
            $(wrapper3).on('click', '.remove_button3', function(e){ //Once remove button is clicked
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });


        })
    </script>




@endsection