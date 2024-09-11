<div class='all-info' id="lan">
    <div class='sub-header'>
        <h4>Language </h4>
        <div class='edit-tools' style="display: none">
            <button class='btn edit-btn'><i class='icon-pencil-o'></i>&nbsp;Edit</button>
            <button class='btn delete-btn'><i class='icon-trush-can'></i>&nbsp;Delete</button>
        </div>
    </div>
    <div id='alertDiv_lan'>

    </div>
    {!! Form::open(['url'=>'lan-edit-submit','files'=>true,'class'=>'row formSubmit']) !!}
        <div class='form-group col-md-6'>
            <label for=''>Language<abbr title='Required' class='required'></abbr></label>
            <input type='text' required class='form-control mandatory jqValidate_lan' id='50' name='language' placeholder='' value=''>
            <input type='hidden' value='-1' name='txtLanguageID' />
            <input type='hidden' class='form-control' placeholder='' id='lanItemNo' name='txtLanItemNo' value=''>
        </div>
        <div class='form-group col-md-6'>
            <label for=''>Reading&nbsp;<abbr title='Required' class='required'></abbr></label>
            <select class='form-control mandatory jqValidate_lan' required name='reading' id='10'>
                <option value='Select'>Select</option>
                <option value='High'>High</option>
                <option value='Medium'>Medium</option>
                <option value='Low'>Low</option>
            </select>
        </div>
        <div class='form-group col-md-6'>
            <label for=''>Writing&nbsp;<abbr title='Required' class='required'></abbr></label>
            <select class='form-control mandatory  jqValidate_lan' name='writing' id='10'>
                <option value='Select'>Select</option>
                <option value='High'>High</option>
                <option value='Medium'>Medium</option>
                <option value='Low'>Low</option>
            </select>
        </div>
        <div class='form-group col-md-6'>
            <label for=''>Speaking&nbsp;<abbr title='Required' class='required'></abbr></label>
            <select class='form-control mandatory  jqValidate_lan' name='speaking' id='10'>
                <option value='Select'>Select</option>
                <option value='High'>High</option>
                <option value='Medium'>Medium</option>
                <option value='Low'>Low</option>
            </select>
        </div>
        <div class='col-md-12 btn-form-control'>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href=javascript:void(0); onClick=closeDiv('lan'); class='btn btn-cancel'>Close</a>
        </div>
    {!! Form::close() !!}
</div>