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
                    <li>Home</li><li>Edit Portfolio</li>
                </ol>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                    <h1 class="page-title txt-color-blueDark">
                        <i class="fa fa-edit fa-fw "></i>
                        Edit Portfolio
                    </h1>
                </div>
            </div>

            @if(Session::has('message'))
                <div class="allert-message alert-success-message pgray  alert-lg" role="alert">
                    <p class=""> {{ Session::get('message') }}</p>
                </div>
            @endif


            <!-- widget grid -->
            <section id="widget-grid" class="">

                    <article class="">
                        <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Edit Portfolio </h2>
                            </header>
                            <div>
                                <div class="widget-body">
                                    {!! Form::model($portfolio, ['route' => ['typePortfolioUpdate', $portfolio->id], 'method' => 'PUT', 'files' => true]) !!}
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select name="type_id"
                                                class="form-control">
                                                <option value="">-Select-</option>
                                                @foreach ($portfolioTypes as $p)
                                                    <option @if($p->id == $portfolio->type->id) selected @endif  value="{{ $p->id }}">{{ $p->title }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" value="{{$portfolio->title}}" required name="title">
                                            </div>
                                            <div class="form-group">
                                                <label>Image</label>
                                                <img src="{{ asset('images/portfolio/'.$portfolio->image) }}" height="50" width="70" alt="">
                                                <p class="image_name"></p>
                                                <div class="input-group">
                                                <tr>
                                                    <button><input type="file" name="image" id="fileToUpload"></button>
                                                </tr>
                                                    <input id="thumbnail" class="form-control" type="hidden" value="{{$portfolio->image}}" name="image">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Link</label>
                                                <input type="text" class="form-control" value="{{$portfolio->link}}" required name="link">
                                            </div>
                                            <div style="margin-bottom: 10px;">
                                                <label>Status</label>
                                                <label class="select">
                                                    {!! Form::select('status', ['Active' => 'Active','InActive' => 'InActive'], $portfolio->status,['class'=>'form-control']) !!}<i></i>
                                                </label>
                                            </div>
                                        </div>



                                    </div>
                                        <footer>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a  class="btn btn-default" href="{{url('admin/add-portfolio-list')}}">Back</a>
                                        </footer>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </article>

            </section>



        </div>


    </div>
@endsection

@section('js')


    <script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script type="text/javascript">


        $(document).ready(function() {


            var maxField = 100; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div  class="fields"> <div class="col-md-11">\n' +
                '                                            <input type="text" required class="form-control" name="feature[]" value=""/>\n' +
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


            var editor_config ={
                path_absolute : "/",
                selector: "textarea.editor",
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern",
                    "textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor",
                relative_urls: false,
                file_browser_callback : function(field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }

                    tinyMCE.activeEditor.windowManager.open({
                        file : cmsURL,
                        title : 'Filemanager',
                        width : x * 0.8,
                        height : y * 0.8,
                        resizable : "yes",
                        close_previous : "no"
                    });
                }
            };
            tinymce.init(editor_config);



            $.fn.filemanager_image = function(type, options) {
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

                        // view file name
                        file_path_arr = file_path.split('/');
                        file_name = file_path_arr[file_path_arr.length-1];
                        $('.image_name').text(file_name).trigger('change');

                        //set or change the preview image src
                        var target_preview = $('#' + localStorage.getItem('target_preview'));
                        target_preview.attr('src', url).trigger('change');
                    };
                    return false;
                });
            }

            $('.lfm').filemanager_image('image');

            $('.ckeditor').show();
            $('iframe').css('height','300px');



        })
    </script>

@endsection
