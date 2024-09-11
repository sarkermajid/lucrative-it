<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-warning">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Safog Year Section
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Want to show this section?</label>
                            <label class="radio-inline">
                                <input type="radio" {{isset($extra_field[0])?($extra_field[0]=='yes'?'checked':''):''}} value="yes" name="extra[]" checked>Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" {{isset($extra_field[0])?($extra_field[0]=='no'?'checked':''):''}} value="no" name="extra[]">No
                            </label>
                        </div>

                        <div class="form-group">
                            <label>Safog Year Title</label>
                            <input type="text" value="{{isset($extra_field[1])?$extra_field[1]:''}}" class="form-control"  name="extra[]">
                        </div>
                        <div class="form-group">
                            <label>Youtube</label>
                            <input type="url" value="{{isset($extra_field[2])?$extra_field[2]:''}}" class="form-control"  name="extra[]">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <img id="holder_extra_file" src="{{asset($extra_file)}}" style="margin-top:15px;margin-bottom:5px;max-width:100%;">
                            @php $file_array = explode('/',$extra_file); @endphp
                            <p class="image_name">{{end($file_array)}}</p>
                            <div class="input-group">
                                  <span class="input-group-btn">
                                    <a  data-input="thumbnail_extra_file" data-preview="holder_extra_file" style="width: 100%" class="lfm btn btn-primary">
                                      <i class="fa fa-picture-o"></i> {{($extra_file)?'Change Youtube Image':'Choose Youtube Image'}}
                                    </a>
                                  </span>
                                  <input id="thumbnail_extra_file" class="form-control" value="{{$extra_file}}" type="hidden" name="extra_file">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Detail</label>
                    <textarea class="editor"  rows="10" name="extra[]"  class="custom-scroll">{{isset($extra_field[3])?$extra_field[3]:''}}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-warning">
        <div class="panel-heading" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Venue Section
                </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Want to show this section</label>
                            <label class="radio-inline">
                                <input type="radio" {{isset($extra1)?($extra1=='yes'?'checked':''):''}} value="yes" name="extra1" checked>Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" {{isset($extra1)?($extra1=='no'?'checked':''):''}} value="no" name="extra1">No
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" value="{{isset($extra_field[4])?$extra_field[4]:''}}" class="form-control"  name="extra[]">
                        </div>
                        <div class="form-group">
                            <label>Sub Title</label>
                            <input type="text" value="{{isset($extra_field[5])?$extra_field[5]:''}}" class="form-control"  name="extra[]">
                        </div>
                        <div class="form-group">
                            <label>Venue Address</label>
                            <input type="text" value="{{isset($extra_field[6])?$extra_field[6]:''}}" class="form-control"  name="extra[]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <img id="holder_venue_image" src="{{asset($venue_image)}}" style="margin-top:15px;max-width:100%;">
                            @php $file_array = explode('/',$venue_image); @endphp
                            <p class="image_name">{{end($file_array)}}</p>
                            <div class="input-group">
                                  <span class="input-group-btn">
                                    <a  data-input="thumbnail_venue_image" data-preview="holder_venue_image" style="width: 100%" class="lfm btn btn-primary">
                                      <i class="fa fa-picture-o"></i> {{($venue_image)?'Change Image':'Choose Image'}}
                                    </a>
                                  </span>
                                  <input id="thumbnail_venue_image" class="form-control" value="{{$venue_image}}" type="hidden" name="venue_image">
                            </div>

                        </div>
                    </div>

                </div>







            </div>
        </div>
    </div>

</div>



    <div class="form-group">
        <label class="checkbox-inline"><input type="checkbox" {{isset($extra_field[7])?($extra_field[7]=='yes'?'checked':''):''}} name="extra[]" value="yes">Want to show sponsor section</label>
    </div>



    <script>
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


        $(document).ready(function(){
            $("a.collapsed").click(function(){
                $(this).find(".btn:contains('answer')").toggleClass("collapsed");
            });
        });


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

        $('.lfm').filemanager('image');


    </script>





