<div class='all-info spe_0'>
    <div id='alertDiv_spe'>

    </div>
    <div class='sub-header'>
        <div class='edit-tools'>
            <button class='btn edit-btn' ><i class='icon-pencil-o'></i>&nbsp;Edit</button>
        </div>
    </div>
    <form class='row' id='speForm'>
        <div class='form-group col-md-12'>
            <label for=''>skills<span class='btn-form-control'>(max 10)</span></label>
            <div class='' id='SkillAreaDiv'>
                <input type='hidden' value='add' name='addField' id='addField'/>
                <div id='lstJobArea'><div class='selected-location'>
                        <input type='text' id='txtSkillrea' name='txtSkillrea' class='autosuggest txt-add-location ui-autocomplete-input btn-form-control form-control' onClick=SetParam(4,'hid_SkArea','',9,''); placeholder='Add more...'>
                        <div class='chips-container' id='FilterSkill'>

                        </div>
                        <input  type='hidden'  name='hid_SkArea' id='hid_SkArea' readonly='readonly'>
                    </div>
                </div>
            </div>
        </div>
        <INPUT id='hid_Skill' type='hidden' name='hid_Skill' value=''>
        <input type='hidden' name='subCatId' value='' id='subCatId'>
        <input type='hidden' name='isBlueColor' id='isBlueColor' value='False'>
        <div class='form-group col-md-12'>
            <label for=''>Skill Description&nbsp:</label>
            <textarea name='txtDescription' id='txtDescription' cols='30' rows='3' class='form-control'></textarea>
        </div>
        <div class='form-group col-md-12'>
            <label for=''>Extracurricular Activities&nbsp:</label>
            <textarea name='txtActivities' id='txtActivities' cols='30' rows='3' class='form-control'></textarea>
        </div>
        <div class='col-md-12 btn-form-control'>
            <a href='javascript:void(0)' class='btn btn-primary save' onclick=commonUpdate('step_04_update_spe.asp','speForm','spe_0','EN');>Save</a>
            <a href='other.html'; class='btn btn-cancel'>Close</a>
        </div>
    </form>
</div>


