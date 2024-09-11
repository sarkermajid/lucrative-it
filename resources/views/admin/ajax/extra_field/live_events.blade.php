

                        <div class="form-group">
                            <label>Youtube</label>
                            <input type="url" value="{{isset($extra_field['youtube'])?$extra_field['youtube']:''}}" class="form-control"  name="extra[youtube]">
                        </div>



                        <div class="form-group">
                            <img id="holder_extra_file" src="{{asset(isset($extra_field['youtube_image'])?$extra_field['youtube_image']:'')}}" style="margin-top:15px;margin-bottom:5px;max-width:100%;">
                            @php $file_array = explode('/',isset($extra_field['youtube_image'])?$extra_field['youtube_image']:''); @endphp
                            <p class="image_name">{{end($file_array)}}</p>
                            <div class="input-group">
                                  <span class="input-group-btn">
                                    <a  data-input="thumbnail_extra_file" data-preview="holder_extra_file" style="width: 100%" class="lfm btn btn-primary">
                                      <i class="fa fa-picture-o"></i> {{($extra_field['youtube_image'])?'Change Youtube Image':'Choose Youtube Image'}}
                                    </a>
                                  </span>
                                  <input id="thumbnail_extra_file" class="form-control" value="{{ isset($extra_field['youtube_image'])?$extra_field['youtube_image']:''}}" type="hidden" name="extra[youtube_image]">
                            </div>
                        </div>



    <script>

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





