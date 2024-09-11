<div class='all-info' id="tr">
    <div class='sub-header'>
        <h4>Training</h4>
        <div class='edit-tools' style="display: none">
            <button class='btn edit-btn'><i class='icon-pencil-o'></i>&nbsp;Edit</button>
            <button class='btn delete-btn'><i class='icon-trush-can'></i>&nbsp;Delete</button>
        </div>
    </div>
    <div id='alertDiv_tr'>

    </div>
    {!! Form::open(['url'=>'tr-edit-submit','files'=>true,'class'=>'row formSubmit','id'=>'educationFormInsert']) !!}
        <div class='form-group col-md-6'>
            <label for=''>Training Title&nbsp;<abbr title='Required' class='required'></abbr></label>
            <input type='text' class='form-control mandatory jqValidate_tr' id='100' placeholder='' name='training_title' value=''>
            <input type='hidden' class='form-control' placeholder='' name='txtT_ID' value='-1' >
            <input type='hidden' class='form-control' placeholder='' id='trItemNo' name='txtTrItemNo' value=''>
        </div>
        <div class='form-group col-md-6'>
            <label for=''>Country&nbsp;<abbr title='Required' class='required'></abbr></label>
            <input type='text' class='form-control mandatory jqValidate_tr' id='50' placeholder='' name='country' value=''>
        </div>
        <div class='form-group col-md-6'>
            <label for=''>Topics Covered</label>
            <input type='text' class='form-control  jqValidate_tr txtTopic' id='300' placeholder='' name='topics_covered'  value=''>
        </div>
        <div class='form-group col-md-6'>
            <label for=''>Training Year&nbsp;<abbr title='Required' class='required'></abbr></label>
            <select class='form-control mandatory jqValidate_tr' name='training_year' id=''>
                <option value='' selected='selected'>Select</option>
                <option value='2024'>2024</option>
                <option value='2023'>2023</option>
                <option value='2022'>2022</option><option value='2021'>2021</option><option value='2020'>2020</option><option value='2019'>2019</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option><option value='2013'>2013</option><option value='2012'>2012</option><option value='2011'>2011</option><option value='2010'>2010</option><option value='2009'>2009</option><option value='2008'>2008</option><option value='2007'>2007</option><option value='2006'>2006</option><option value='2005'>2005</option><option value='2004'>2004</option><option value='2003'>2003</option><option value='2002'>2002</option><option value='2001'>2001</option><option value='2000'>2000</option><option value='1999'>1999</option><option value='1998'>1998</option><option value='1997'>1997</option><option value='1996'>1996</option><option value='1995'>1995</option><option value='1994'>1994</option><option value='1993'>1993</option><option value='1992'>1992</option><option value='1991'>1991</option><option value='1990'>1990</option><option value='1989'>1989</option><option value='1988'>1988</option><option value='1987'>1987</option><option value='1986'>1986</option><option value='1985'>1985</option><option value='1984'>1984</option><option value='1983'>1983</option><option value='1982'>1982</option><option value='1981'>1981</option><option value='1980'>1980</option><option value='1979'>1979</option><option value='1978'>1978</option><option value='1977'>1977</option><option value='1976'>1976</option><option value='1975'>1975</option><option value='1974'>1974</option><option value='1973'>1973</option><option value='1972'>1972</option><option value='1971'>1971</option><option value='1970'>1970</option><option value='1969'>1969</option><option value='1968'>1968</option><option value='1967'>1967</option><option value='1966'>1966</option><option value='1965'>1965</option><option value='1964'>1964</option></select>
        </div>
    <div class='form-group col-md-6'><label for=''>Institute&nbsp;<abbr title='Required' class='required'></abbr></label>
        <input type='text' class='form-control mandatory jqValidate_tr' id='80' placeholder='' name='institute' value=''>
    </div>
    <div class='form-group col-md-6'>
        <label for=''>Duration&nbsp;<abbr title='Required' class='required'></abbr></label>
        <input type='text' class='form-control mandatory jqValidate_tr' placeholder='' id='10' name='duration' value=''>
    </div>
        <div class='form-group col-md-6'>
            <label for=''>Location</label>
            <input type='text' class='form-control jqValidate_tr' id='50' placeholder='' name='location' value=''>
            <input type='hidden' name='isBlueColor' id='isBlueColor' value='False'>
        </div>
        <div class='col-md-12 btn-form-control'>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href=javascript:void(0); onClick=closeDiv('tr'); class='btn btn-cancel'>Close</a>
        </div>
    {!! Form::close() !!}
</div>

