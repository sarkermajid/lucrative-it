<div class='all-info aca_0' id="aca">
   <div class='sub-header'>
      <div id='alertDiv_aca'></div>
      <h4>Academic </h4>
      <div class='edit-tools' style="display: none">
         <button class='btn edit-btn' ><i class='icon-pencil-o'></i>&nbsp;Edit</button>
         <button class='btn delete-btn'></i>&nbsp;Delete</button>
      </div>
   </div>
   {!! Form::open(['url'=>'aca-edit-submit','files'=>true,'class'=>'row formSubmit','id'=>'educationFormInsert']) !!}
   <input type="hidden" value="" name="id">
      <div class='col-md-6'>
         <div class='row'>
            <div class='form-group col-md-12'>
               <label for=''>Level of Education&nbsp;<abbr title='Required' class='required'></abbr></label>
               <select required='required' class='form-control' name='education_level' id='cboEduLevel' onchange=getEduTitle(this,'','','');>
                  <option value=''>Select</option>
                  <option value='PSC/5 pass'>PSC/5 pass</option>
                  <option value='JSC/JDC/8 pass'>JSC/JDC/8 pass</option>
                  <option value='Secondary'>Secondary</option>
                  <option value='Higher Secondary'>Higher Secondary</option>
                  <option value='Diploma'>Diploma</option>
                  <option value='Bachelor/Honors'>Bachelor/Honors</option>
                  <option value='Masters'>Masters</option>
                  <option value='PhD (Doctor of Philosophy)'>PhD (Doctor of Philosophy)</option>
               </select>

            </div>
            <div class='education-type form-group col-md-12'>
               <label for=''>Exam/Degree Title:<abbr title='Required' class='required'></abbr></label>
               <div class='row'>
                  <div class='col-md-12' id='divEduType' style='display:block;'>
                     <select required class='form-control' name='exam_title' id='exam_title' onchange=DisableOtherEduType();>
                        <option value=''>Select</option>
                        <option value='SSC'>SSC</option>
                        <option value='O Level'>O Level</option>
                        <option value='Dakhil (Madrasah)'>Dakhil (Madrasah)</option>
                        <option value='SSC (Vocational)'>SSC (Vocational)</option>
                        <option value='others'>Other</option>
                     </select>
                  </div>
                  <div class='col-md-12'>
                     <input type='text' class='form-control m-t-10' style='display:none;'name='hiddenOtherEduType' id='hiddenOtherEduType' placeholder='Type exam/degree title' value=''>
                     <input type='hidden' value='1' name='educationTypeId' id='educationTypeId'/>
                  </div>
               </div>
            </div>
            <input type='hidden' id='hecode' name='hecode' value='-1' />
            <input type='hidden' name='item_no' value='' id='acaItemNo' />
            <div class='form-group col-md-12'>
               <label for=''>Concentration/ Major/Group&nbsp;<abbr title='Required' class='required'></abbr></label>
               <input type='text' id='txtMajorGroup' name='concentration' class='form-control' placeholder='' value=''>
               <input type='hidden' name='hidMajor' id='hidMajor' />
            </div>

            <div class='form-group col-md-12' id='showBoard'>
               <label for=''>Board&nbsp;<abbr title='Required' class='required'></abbr></label>
               <select class='form-control' name='board' id='txtExamBoard' ><option value='-1' Selected>Select</option>
                  <option value='6'>Barishal</option><option value='5'>Chattogram</option><option value='3'>Cumilla</option>
                  <option value='1'>Dhaka</option><option value='10'>Dinajpur</option><option value='4'>Jashore</option>
                  <option value='2'>Rajshahi</option><option value='7'>Sylhet</option><option value='8'>Madrasah</option>
                  <option value='9'>Technical</option>
               </select>
            </div>

            <div class='form-group col-md-12'>
               <label for=''>Institute Name&nbsp;<abbr title='Required' class='required'></abbr></label>
               <input type='text' id='txtInstituteName' name='instute_name' class='form-control' placeholder='' value=''>
            </div>
         </div>
      </div>

      <div class='col-md-6'>
         <div class='row'>
            <div class='form-group col-md-12'>
               <label for=''>CGPA&nbsp;<abbr title='Required' class='required'></abbr></label>
               <input type='text' class='form-control' placeholder='' value='' name='result'>
            </div>
            <div class='form-group col-md-12 hidden' id='marksDiv'>
               <label for='' id='labMarks'> Marks&nbsp;(%)&nbsp;<abbr title='Required' class='required'></abbr></label>
               <input type='text' id='txtMarks' name='txtMarks' onblur='extractNumber(this,2,false)' onkeyup='extractNumber(this,2,false)' onkeypress='return blockNonNumbers(this, event, true, false);' class='form-control' placeholder='' value=''>
            </div>
            <div class='form-group col-md-12 hidden' id='scaleDiv'>
               <label for=''>Scale&nbsp;<abbr title='Required' class='required'></abbr></label><input class='form-control' id='txtScale' name='txtScale' onblur='extractNumber(this,2,false)' onkeyup='extractNumber(this,2,false)' onkeypress='return blockNonNumbers(this, event, true, false);' placeholder='' value=''  type='text'>
            </div>
            <div class='form-group col-md-12'>
               <label for='' id='yrsOfPass'><span>Year of Passing</span>&nbsp;<abbr title='Required' class='required'></abbr></label>
               <select class='form-control' name='passing_year' id='cboPassingYear'>
                  <option value='-1' Selected>Year</option>
                  <option value='2024'>2024</option>
                  <option value='2023'>2023</option>
                  <option value='2022'>2022</option>
                  <option value='2021'>2021</option>
                  <option value='2020'>2020</option>
                  <option value='2019'>2019</option>
                  <option value='2018'>2018</option>
                  <option value='2017'>2017</option>
                  <option value='2016'>2016</option>
                  <option value='2015'>2015</option>
                  <option value='2014'>2014</option>
                  <option value='2013'>2013</option>
                  <option value='2012'>2012</option>
                  <option value='2011'>2011</option>
                  <option value='2010'>2010</option>
                  <option value='2009'>2009</option>
                  <option value='2008'>2008</option>
                  <option value='2007'>2007</option>
                  <option value='2006'>2006</option>
                  <option value='2005'>2005</option>
                  <option value='2004'>2004</option>
                  <option value='2003'>2003</option>
                  <option value='2002'>2002</option>
                  <option value='2001'>2001</option>
                  <option value='2000'>2000</option>
                  <option value='1999'>1999</option>
                  <option value='1998'>1998</option>
                  <option value='1997'>1997</option>
                  <option value='1996'>1996</option>
                  <option value='1995'>1995</option>
                  <option value='1994'>1994</option>
                  <option value='1993'>1993</option>
                  <option value='1992'>1992</option><option value='1991'>1991</option><option value='1990'>1990</option><option value='1989'>1989</option><option value='1988'>1988</option><option value='1987'>1987</option><option value='1986'>1986</option><option value='1985'>1985</option><option value='1984'>1984</option><option value='1983'>1983</option><option value='1982'>1982</option><option value='1981'>1981</option><option value='1980'>1980</option><option value='1979'>1979</option><option value='1978'>1978</option><option value='1977'>1977</option><option value='1976'>1976</option><option value='1975'>1975</option><option value='1974'>1974</option><option value='1973'>1973</option><option value='1972'>1972</option><option value='1971'>1971</option><option value='1970'>1970</option><option value='1969'>1969</option><option value='1968'>1968</option><option value='1967'>1967</option><option value='1966'>1966</option><option value='1965'>1965</option><option value='1964'>1964</option>
               </select>
            </div>
            <div class='form-group col-md-12'>
               <label for=''>Duration&nbsp;<small>(Years)</small></label>
               <input type='text' class='form-control' placeholder='' value='' name='duration'>
            </div>
            <input type='hidden' name='isBlueColor' id='isBlueColor' value='False'>
         </div>
      </div>

      <div class='form-group col-md-12'> <label for=''>Achievement</label>
         <input type='text' class='form-control' placeholder='' value='' name='achievement'>
      </div>
      <div class='col-md-12 btn-form-control'>
         <button type="submit" class="btn btn-primary">Save</button>
         <a onClick=closeDiv('aca'); class='btn btn-cancel' href=javascript:void(0);>Close</a>
      </div>
   {!! Form::close() !!}
</div>



