<div class='all-info' id="ref">
    <div class='sub-header'>
        <h4>Reference </h4>
        <div class='edit-tools' style='display:none'>
            <button class='btn edit-btn'><i class='icon-pencil-o'></i>&nbsp;Edit</button>
            <button class='btn delete-btn'><i class='icon-trush-can'></i>&nbsp;Delete</button>
        </div>
    </div>
    <div id='alertDiv_ref' >

    </div>
    {!! Form::open(['url'=>'ref-edit-submit','files'=>true,'class'=>'row formSubmit']) !!}
        <div class='col-md-9 col-xs-9'>
            <input type='hidden' name='hR_Code' id='hR_Code' value='-1'/>
            <input type='hidden' id='refItemNo' name='txtRefItemNo' value=''/>
        </div><div class='col-md-6'>
            <div class='row'>
                <div class='form-group col-md-12'>
                    <label for=''>Name&nbsp;<abbr title='Required' class='required'></abbr></label>
                    <input type='text' required name='name' id='50' class='form-control mandatory jqValidate_ref' placeholder='' value=''>
                </div>
                <div class='form-group col-md-12'>
                    <label for=''>Designation&nbsp;<abbr title='Required' class='required'></abbr></label>
                    <input type='text' name='designation' id='50' class='form-control mandatory jqValidate_ref' placeholder='' value=''>
                </div>
                <div class='form-group col-md-12'>
                    <label for=''>Mobile&nbsp;</label>
                    <input type='text' name='mobile' id='50' class='form-control jqValidate_ref' placeholder='' value=''>
                </div>
                <div class='form-group col-md-12'>
                    <label for=''>Email&nbsp;</label>
                    <input type='text' name='email' id='50' class='form-control jqValidate_ref' placeholder='' value=''>
                </div>
                <div class='form-group col-md-12'>
                    <label for=''>Relation&nbsp;</label>
                    <select class='form-control jqValidate_ref' name='relation' id='cboRRelation1'>
                        <option value='Relative'>Relative</option>
                        <option value='Family Friend'>Family Friend</option>
                        <option value='Academic'>Academic</option>
                        <option value='Professional'>Professional</option>
                        <option value='Others'>Others</option>
                    </select>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='row'>
                <div class='form-group col-md-12'>
                    <label for=''>Organization&nbsp;<abbr title='Required' class='required'></abbr></label>
                    <input type='text' name='organization' id='50' class='form-control mandatory jqValidate_ref' placeholder='' value=''>
                </div>
                <div class='form-group col-md-12'>
                    <label for=''>Phone (Off)&nbsp;</label>
                    <input type='text' name='phone_off' id='50' class='form-control jqValidate_ref' placeholder='' value=''>
                </div>
                <div class='form-group col-md-12'>
                    <label for=''>Phone (Res)&nbsp;</label>
                    <input type='text' name='phone_res' id='50' class='form-control jqValidate_ref' placeholder='' value=''>
                    <input type='hidden' name='isBlueColor' id='isBlueColor' value='False'>
                </div>
                <div class='form-group col-md-12'>
                    <label for=''>Address</label>
                    <textarea name='address' id='250' cols='30' rows='3' class='form-control jqValidate_ref_'></textarea>
                </div>
            </div>
        </div>
        <div class='col-md-12 btn-form-control'>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href='javascript:void(0)' onClick=closeDiv('ref')  class='btn btn-cancel'>Close</a>
        </div>
    {!! Form::close() !!}
</div>