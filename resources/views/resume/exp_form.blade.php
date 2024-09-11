<div class='all-info' id="exp">
   <div class='sub-header'>
      <h4>Add Experience </h4>
   </div>
   {!! Form::open(['url'=>'exp-edit-submit','files'=>true,'class'=>'row formSubmit']) !!}
   <input type="hidden" value="" name="id">
      <div id='alertDiv_exp'></div>
      <div class='col-md-6'>
         <div class='row'>
            <div class='form-group col-md-12'>
               <label for=''>Company Name&nbsp;<abbr title='Required' class='required'></abbr></label>
               <input type='text' required class='form-control' placeholder='' name='company_name' id='txtCompany'>
            </div>
            <div class='form-group col-md-12'>
               <label for=''>Company Business&nbsp;<abbr title='Required' class='required'></abbr></label>
               <input type='text' class='form-control autosuggest ui-autocomplete-input' placeholder='' value='' id='company_business' name='company_business'>
            </div>
            <div class='form-group col-md-12'>
               <label for=''>Designation&nbsp;<abbr title='Required' class='required'></abbr></label>
               <input type='text' class='form-control' placeholder='' value='' name='designation' id='txtEPosition'>
            </div>
            <div class='form-group col-md-12'><label for=''>Department&nbsp;</label>
               <input type='text' class='form-control' placeholder='' value='' name='department' id='txtDept'>
            </div>
            <div class='form-group col-md-12'>
               <label for=''>Area of Experiences:&nbsp;<abbr title='Required' class='required'></abbr></label>
               <div class='' id='prefOrgDiv'>
                  <span class='input-note m-b-10 btn-form-control'>Add your expertise skill (max 3)</span><div id='lstJobArea'>
                     <div class='selected-location'>
                        <input type='text' id='txtExpArea' name='experiences_area' class='autosuggest txt-add-location ui-autocomplete-input btn-form-control form-control' onClick=SetParam(3,'hid_ExpArea','',5,''); placeholder='Add expertise skill ...' autocomplete='off'>
                        <div class='chips-container' id='FilterWorkArea'></div>
                        <input  type='hidden'  name='hid_ExpArea' id='hid_ExpArea' readonly='readonly'>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class='col-md-6'>
         <div class='row'>
            <div class='form-group col-md-12'><label for=''>Responsibilities&nbsp;</label>
               <textarea id='txtDuty' name='responsibilities' cols='30' rows='4' class='form-control '></textarea>
            </div>
            <div class='form-group col-md-12'><label for=''>Company Location</label>
               <input type='text' class='form-control' placeholder='' value='' name='company_location' id='txtCLocation'></div><div class='form-group col-md-12' style='margin:0;'><label for=''>Employment Period&nbsp;<abbr title='Required' class='required'></abbr></label>
            </div>
            <div class='form-group col-md-6'>
               <input type='text' class='form-control datepicker fromDate' value='' id='start_date' name='cboFromDate' placeholder='From'>
            </div>
            <div class='form-group col-md-6'>
               <input type='text' class='form-control datepicker toDate' value='' id='end_date' name='cboTODate' placeholder='To'>
            </div>
            <div class='form-group col-md-12 btn-form-control'>
               <label class='checkbox-inline'>
                  <input type='checkbox' name='currently_working' id='chkContinue' onClick=SetValue('expForm'); value='Yes'> Currently Working
               </label>
            </div>
         </div>
      </div>
      <div class='col-md-12 btn-form-control'>
         <button type="submit" class="btn btn-primary">Save</button>
         <a href="{{ url('resume-view-step1') }}" class="btn btn-default btn-cancel reset">Close</a>
      </div>
   {!! Form::close() !!}
</div>