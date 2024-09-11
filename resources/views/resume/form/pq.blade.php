<div class='all-info' id="pq">
    <div class='sub-header'>
        <h4>Professional Qualification </h4>
        <div class='edit-tools' style="display: none">
            <button class='btn edit-btn'><i class='icon-pencil-o'></i>&nbsp;Edit</button>
            <button class='btn delete-btn'><i class='icon-trush-can'></i>&nbsp;Delete</button>
        </div>
    </div>
    <div id='alertDiv_pq'></div>
    {!! Form::open(['url'=>'pq-edit-submit','files'=>true,'class'=>'row formSubmit','id'=>'educationFormInsert']) !!}
        <div class='col-md-9 col-xs-9'>
            <input type='hidden' name='txtPQ_Code' id='pQ_Code' value='-1'>
            <input type='hidden' id='pqItemNo'  name='txtPqItemNo' value=''>
        </div>
        <div class='col-md-6'>
            <div class='row'>
                <div class='form-group col-md-12'>
                    <label for=''>Certification&nbsp;<abbr title='Required' class='required'></abbr></label>
                    <input type='text' class='form-control mandatory jqValidate_pq' id='80' name='certification' placeholder='' value=''>
                </div>
                <div class='form-group col-md-12'>
                    <label for=''>Institute&nbsp;<abbr title='Required' class='required'></abbr></label>
                    <input type='text' name='txtInstitute' class='form-control mandatory jqValidate_pq' id='80' placeholder='' value=''>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='row'>
                <div class='form-group col-md-12'>
                    <label for=''>Location</label>
                    <input type='text' name='txtLocation' class='form-control jqValidate_pq' id='50' placeholder='' value=''>
                </div>
                <div class='form-group col-md-12' style='margin:0;'>
                    <label for=''>Certification Period&nbsp;<abbr title='Required' class='required'></abbr></label>
                </div>
                <div class='form-group col-md-6'>
                    <input type='text' name='calFromDate' class='form-control  mandatory jqValidate_pq datepicker fromDate' id='1000' placeholder='mm/dd/yyyy' value=''>
                </div>
                <div class='form-group col-md-6'>
                    <input type='text' name='calToDate' class='form-control  mandatory jqValidate_pq datepicker toDate greater' id='1000' placeholder='mm/dd/yyyy' value=''>
                </div>
            </div>
        </div>
        <input type='hidden' name='hCurrentDate' id ='hCurrentDate' value='4/22/2019'>
        <div class='col-md-12 btn-form-control'>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href=javascript:void(0); onClick=closeDiv('pq'); class='btn btn-cancel'>Close</a>
        </div>
    {!! Form::close() !!}
</div>

