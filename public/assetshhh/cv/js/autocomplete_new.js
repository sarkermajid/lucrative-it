  var paramName="" ;
  var hiddenIdField = "";
  var con = "";
  var param1, param2, param3, param4, param5, param6, param7, param8, param9, param10, param11,systemname,systemTitle,noFoundMessageBn
 
   var len=0;
   function SetParam(val,hidFieldName,condition,system,formSI)
   {
	  
	  	  paramName     = val;
	  hiddenIdField = hidFieldName;
	  con = condition;
	  systemname = system;
	  if(systemname == 1)
	  {
		 //personal details current location
		  param1  = ""
		  param2  = "subcurrentDiv"
		  param3  = ""
		  param4  = ""
		  param5  = ""
		  param6  = ""
		  param7  = ""
		  param8  = "txtCurrentLoc"
		  param9  = lang
		  param10 = "hid_current_location"
		  param11 = "1"
		  con = currentLocation;
		  systemTitle = "location"
		  noFoundMessageBn = "কোন লোকেশন খুঁজে পাওয়া যায়নি"
	  }
	  if(systemname == 2)
	  {
		  //preferred job location inside bangladesh
		  param1  = "location"
		  param2  = "subInsideDiv"
		  param3  = "dist"
		  param4  = "FilterLocation"
		  param5  = "selected_Dist"
		  param6  = "hidCountDist"
		  param7  = "subCatId"
		  param8  = "txtSubject"
		  param9  = lang
		  param10 = "hid_location"
		  param11 = "15"
		  systemTitle = "location"
		  noFoundMessageBn = "জেলা খুঁজে পাওয়া যাচ্ছে না"
	  }
	  if(systemname == 3)
	  {
		  //preferred job location outside bangladesh
		  param1  = "location"
		  param2  = "subOutsideDiv"
		  param3  = "over"
		  param4  = "FilterOverseas"
		  param5  = "selected_JobCountry"
		  param6  = "hidCountOver"
		  param7  = "subCatId"
		  param8  = "txtOutSide"
		  param9  = lang
		  param10 = "hid_outLocation"
		  param11 = "10"
		  systemTitle = "location"
		  noFoundMessageBn = "দেশ খুঁজে পাওয়া যাচ্ছে না"
	  }
	  if (systemname == 4)
	  {
		  //preferred organization
		  param1  = "organization"
		  param2  = "prefOrgDiv"
		  param3  = "org"
		  param4  = "FilterOrg"
		  param5  = "selected_Job"
		  param6  = "hidOrg"
		  param7  = ""
		  param8  = "txtJobArea"
		  param9  = lang
		  param10 = "hid_jobArea"
		  param11 = "12"
		  systemTitle = "organization"
		  noFoundMessageBn = "কোন প্রতিষ্ঠান খুঁজে পাওয়া যায়নি"
		}
	  
	  if (systemname == 5)
	  {
		  //preferred work area 
		  param1  = "exp"
		  param2  = "ExpDiv"
		 
		  if(formSI === "")
		  {
			  param3  = "work"
			  param4  = "FilterWorkArea"
			  param5  = "SWorkArea"
			  param6  = "hidWorkArea"
			  param7  = "subCatId"
		  }else
		  {
			  param3  = "work"+formSI
			  param4  = "FilterWorkArea"+formSI
			  param5  = "SWorkArea"+formSI
			  param6  = "hidWorkArea"+formSI
			  param7  = "subCatId"+formSI
		  }
		  param8  = "txtExpArea"
		  param9  = lang
		  param10 = "hid_ExpArea"
		  param11 = "3"
		  systemTitle = "area of experience"
		  noFoundMessageBn = "কোন কর্মক্ষেত্রের এরিয়া পাওয়া যায়নি"
		  
	  }
	  if (systemname == 6)
	  {
		  //company business
		  param1  = ""
		  param2  = ""
		  param3  = ""
		  param4  = ""
		  param5  = ""
		  param6  = ""
		  param7  = ""
		  if(formSI === ""){
			  param8  = "cboBusiness"
		  }else
		  {
			  param8  = "cboBusiness_"+formSI
		  }
		  
		  param9  = lang
		  param10 = "hid_cbo_business"
		  param11 = "1"
		}
		if (systemname == 7)
		{
		  //major subject
		  param1  = ""
		  param2  = ""
		  param3  = ""
		  param4  = ""
		  param5  = ""
		  param6  = ""
		  param7  = ""
		  if(formSI === ""){
		  	  param8  = "txtMajorGroup"
		  }else
		  {
			  param8  = "txtMajorGroup"+formSI
		  }
		  param9  = lang
		  param10 = "hidMajor"
		  param11 = "1"
		}
		if (systemname == 8)
		{
			//Institute name
		  param1  = ""
		  param2  = ""
		  param3  = ""
		  param4  = ""
		  param5  = ""
		  param6  = ""
		  param7  = ""
		  if(formSI === ""){
			  param8  = "txtInstituteName"
		  }
		  else
		  {
			  param8  = "txtInstituteName"+formSI
		  }
		  param9  = lang
		  param10 = "hiddenInstitute"
		  param11 = "1"
		}
		if (systemname == 9)
		{
			//skill
		  param1  = "skill"
		  param2  = "SkillAreaDiv"
		  param3  = "skill"
		  param4  = "FilterSkill"
		  param5  = "hid_Skill"
		  param6  = "hSkillItem"
		  param7  = "subCatId"
		  param8  = "txtSkillrea"
		  param9  = lang
		  param10 = "hid_SkArea"
		  param11 = "10"
		  systemTitle = "skill"
		  noFoundMessageBn = "কোন দক্ষতা পাওয়া যায়নি"
		}
   }

//:for autosuggest system
//:to use this page need to include these file jquery-ui.css,autocomplete.css,jquery-2.0.2.js,jquery-ui.js
//:required some parameter
//:parameter term is the user defined text which should be search
//:parameter paramName is the system name
//:parameter con is condition 
//:parameter lang language version
//:Author by sufia afroz

$(function() {
 //alert(tblName+" "+ fieldName1 +" "+ fieldName2);
 RegExp.escape = function(s) {
    return s.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
};
 	$.extend( $.ui.autocomplete.prototype, {
    _renderItem: function( ul, item ) {
        var term = this.element.val(),
		term  = new RegExp(RegExp.escape(term), "i" ),
		html = item.label.replace( term, "<b>$&</b>" );
		//alert(term);
        return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append( $("<a></a>").html(html) )
            .appendTo( ul );
    }
});

//$(".autosuggest").each(function(){
$(document).on("keydown.autocomplete",".autosuggest",function(e){
	$(this).autocomplete({
			source: function(request, response) {
            $.ajax({
                url: "https://mybdjobs.bdjobs.com/mlCommon/new_common/autocomp3_new_s.asp",
                dataType: "json",
                data: {
                    term : request.term,
                    param : paramName,
					con : con,
					ver : lang
					//country_id : $("#country_id").val()
                },
                success: function(data) {
					if(data.length == 0)
					{
						//don't allow user defined text
						if(systemname == 1 || systemname == 2 || systemname == 3 || systemname == 4 || systemname==5 || systemname==9  )
						{
						  $("#"+param8+"").val("");
						  if(lang == "EN")
						  {
						  	alert("No "+systemTitle+" found!");
						  }else
						  {
							  alert(noFoundMessageBn);
						  }
						  return false;
						}
					}
				//console.log(data)
					 $.each(data, function(i) {
						outputdata = data;
						//alert (data[i]);
					});
					response(data);
                }
            });
        },
		 search: function () {
           // $(this).addClass('loadinggif');
			$("#"+hiddenIdField+"").val("");
        },
        response: function (event, ui) {
			
            //$(this).removeClass('loadinggif');
			//len = ui.content.length;
		},
        minLength: 2,
        delay: 300,
		//select: function (event, ui) {
//				
//				//$("#txtAllowSearch").val(ui.item.label); // display the selected text
//				$("#"+hiddenIdField+"").val(ui.item.id); // save selected id to hidden input
//    	},
		select: function (event, ui) {
			$("#"+hiddenIdField+"").val(ui.item.id); 
			var text = ui.item.text;
			$("#"+param8+"").val(text); 
			
			
			if(systemname == 2 || systemname == 3 || systemname == 4 || systemname == 5 || systemname == 9){        
            	addOtherTextInDiv(param1,param2,param3,param4,param5,param6,param7,param8,param9,param10,param11);
				$(this).val("");
			    setTimeout('showAutocomplete()', 10);
            }
			 return false;
			
			
            
        }
    });
});
 
});

//$(document).on("focus click", "#txtSubject", function () {
//    showAutocomplete();
//});
//
function showAutocomplete() {
    if ($(".ui-autocomplete .ui-menu-item").length > 0) {
        $(".ui-autocomplete").css({ left: ($("#"+param8+"").offset().left) + "px", top: ($("#"+param8+"").offset().top + 30) + "px" });
       // $(".ui-autocomplete").show();
    }
}