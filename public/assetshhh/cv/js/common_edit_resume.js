// set edit mode form view mode
//param all-info div's class name
//author: sufia
var mainUrl="https://mybdjobs.bdjobs.com/new_mybdjobs/";
function setEditMode(divID,btn)
{
	var x = document.getElementById(divID).querySelectorAll(".inpClass");
	var y = document.getElementById(divID).querySelectorAll(".para");
	var i;
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "block";
	   y[i].style.display = "none";
    }
	document.getElementById(btn).style.display = "block";

//$("#"+divID).find('.inpClass').type = 'text';
 
}

// set view mode form edit mode
//param all-info div's class name
//author: sufia
function setViewMode(divID)
{
	//$(this).parents('div.all-info').find('form').hide();
	//$(this).parents('div.all-info').find('.panel-details').show();
	//$(this).parents('div.all-info').find('.edit-tools').show();
	
	//$("div."+ divID ).find('form').hide();
	//$("div."+ divID).find('.panel-details').show();
	//$("div."+ divID).find('.edit-tools').show();

	//New Condition for details address  22.11.2018
	if(divID == 'adrs_0'){
		setDetailsAddessViewMode(divID);
	}
	//End block
	
	$('div.'+divID).find('form').addClass('view-mode');
	$('div.'+divID).find('.edit-tools').show();
	$('div.'+divID).find('.btn-form-control').addClass('hidden');
	$('div.'+divID).find('.form-group').find('.onclick-hidden').removeClass('yes');
 
}
//author: Porag
//Details Address viewMode generate 
function setDetailsAddessViewMode(divID){
	if(divID == 'adrs_0'){
		//Present Address
		var LocationVal = $('#addressForm input[name=presentLocation]:checked').val();
		var PresentdistrictTxt = $('#addressForm #present_district :selected').text();
		var PresentthanaTxt = $('#addressForm #present_thana :selected').text();
		var PresentpoTxt = $('#addressForm #present_p_office :selected').text();
		var present_POValue = $('#addressForm #present_p_office :selected').val();//for checking 
		var PresentcountryTxt = $('#addressForm #present_country_list :selected').text();
		var PresentgetVillage = $("#addressForm #present_Village").val();

		//Permanent Address 
		var LocationValPermanent = $('#addressForm input[name=permanentLocation]:checked').val();
		var strPermanentDistrict = $('#addressForm #permanent_district :selected').text();
		var strPermanentThana = $('#addressForm #permanent_thana :selected').text();
		var strPermanentPO = $('#addressForm #permanent_p_office :selected').text();
		var strPermanent_POValue = $('#addressForm #permanent_p_office :selected').val();//for checking 
		var strPermanentCountry = $('#addressForm #permanent_country_list :selected').text();
		var strPermanentVillage = $('#addressForm #permanent_Village').val();

		//Present Address
		if(LocationVal == 0){
			if(present_POValue != "-1"){
				$("#addressForm #txtPresentAdd").html("");
				$("#addressForm #txtPresentAdd").html(PresentgetVillage + ", "+ PresentpoTxt + ", "+ PresentthanaTxt + ", " + PresentdistrictTxt);
			}else{
				$("#addressForm #txtPresentAdd").html("");
				$("#addressForm #txtPresentAdd").html(PresentgetVillage + ", "+ PresentthanaTxt + ", " + PresentdistrictTxt);
			}
		}else{
			$("#addressForm #txtPresentAdd").html("");
			$("#addressForm #txtPresentAdd").html(PresentgetVillage + ", "+ PresentcountryTxt);
		}

		//Permanent Address
		if($('#addressForm .same-address').is(':checked')){ 
			$("#addressForm #txtPermanentAdd").html("");
			console.log('Same as present address!');
		}
		else{
			if(LocationValPermanent == 0){
				if(strPermanent_POValue != "-1"){
					$("#addressForm #txtPermanentAdd").html("");
					$("#addressForm #txtPermanentAdd").html(strPermanentVillage + ", "+ strPermanentPO + ", "+ strPermanentThana + ", " + strPermanentDistrict);
				}else{
					$("#addressForm #txtPermanentAdd").html("");
					$("#addressForm #txtPermanentAdd").html(strPermanentVillage + ", "+ strPermanentThana + ", " + strPermanentDistrict);
				}
			}else if(LocationValPermanent == 1) {
				$("#addressForm #txtPermanentAdd").html("");
				$("#addressForm #txtPermanentAdd").html(strPermanentVillage + ", "+ strPermanentCountry);
			}else{
				console.log("Nothing selected !");
			}
		}
		$('.address_Previous').removeClass('hidden');
		$("#countrySelectID").addClass("hide");
		$("#permanentCountryID").addClass("hide");
	}
}
//End details address 
//====================

//here set validation function name
//param all-info's div class name
//return value: true/false
//author: sufia
function getCommonValidation(strParam,version,formName,itemNo)
{
	 var returnValue;
	if(strParam == "per")
	{
		returnValue = personal_info_validation(version);
	}
	else if(strParam == "cai")
	{
		returnValue = Career_Application_Validate(version);
	}
	else if(strParam == "jclo")
	{
		returnValue = Category_Location_Organization_Validate(version);
	}
	else if(strParam == "ori")
	{
		returnValue = Other_relevant_information(version);
	}
	else if(strParam == "exp")
	{
		returnValue = Experience_Validate_Lightbox(version,formName);
	}
	else if(strParam == "em")
	{
		returnValue = Army_Experience_Validate(strParam,itemNo,version);
	}
	else if(strParam == "aca")
	{
		returnValue = Education_Validate(version,formName,itemNo,version);
	}
	else if(strParam == "ref")
	{
		returnValue = References_Validate(strParam,itemNo,version);
	}
	else if(strParam == "lan")
	{
		returnValue = Language_Proficiency_Validate(strParam,itemNo,version);
	}
	else if(strParam == "tr")
	{
		returnValue = Training_Summary_Validate(strParam,itemNo,version);
	}
	else if(strParam == "pq")
	{
		returnValue = Professional_Summary_Validate(strParam,itemNo,version);
	}
	else if(strParam == "adrs")
	{
		returnValue = Details_Address_Validate(version,'addressForm','alertDiv_adrs');
	}
	
	return returnValue;
}

//call ajax to update the resume
//param:url(server page ),fromName(id name of form), divID(all-info div's class name, version)

function commonUpdate(url,formName,divID,lanType)
{
	
	var type_other=divID.split('_')[0];
	var itemNo=divID.split('_')[1];
	$('#'+formName+ '.btn-primary').prop('disabled', true);
	$('#div_'+type_other+' #'+formName+' .btn-primary').attr("disabled","disabled");
	if(getCommonValidation(type_other,lanType,formName,itemNo) == false)
	{
		$('#div_'+type_other+' #'+formName+' .btn-primary').removeAttr("disabled");
		return false;
	}
	if(url.indexOf("https://mybdjobs.bdjobs.com/new_mybdjobs")==-1)
	{
		url=mainUrl+url;
	}
	$.ajax({
			type: "POST",
			url: url+'?version='+lanType,
			data:   $("#"+formName).serialize(),
			dataType: "html",
			cache: false,
			async:false,
			success: function(responseText){
				console.log("dfg"+responseText);
				if(responseText.indexOf('added') > -1 || responseText.indexOf('updated') > -1)
					{
						var str;
						setViewMode(divID);
						if(lanType == "EN")
						{
							if(responseText.indexOf('added') > -1)
							{
								str = "The information has been added successfully"
								if((type_other == 'adrs'))
								{
									isCvPosted = 'True';
								}
							}else
							{
								str = "The information has been updated successfully"
							}
						}else
						{
							if(responseText.indexOf('added') > -1)
							{
								str = "তথ্য সফলভাবে যুক্ত করা হয়েছে"
								if((type_other == 'adrs'))
								{
									isCvPosted = 'True';
								}
							}else
							{
								str = "তথ্য সফলভাবে আপডেট করা হয়েছে"
							}
						}
						var destination = document.getElementById("destinationPage");
						var strApplyId=document.getElementById("JOB_CID");
						
						if (strApplyId!=null )
						{
							if ( strApplyId.value!='')
							{
							location.reload(true);
							}
						}
						
						
						if($("#commonForm_"+type_other).length != 0){
								var responseStr = responseText;
								var responseStr = responseStr.substring(responseStr.indexOf(".")+1);
								
								if($('#commonForm_'+type_other+'_'+itemNo).length == 0) {
									d = document.createElement('div');
									$(d).attr('id', 'commonForm_'+type_other+'_'+itemNo);
									$(d).html(responseStr);						//var newForm=$('#commonForm_'+type_other+'_'+itemNo).prepend(str);
									 $("#commonForm_"+type_other).append(d)
								
							  //it doesn't exist
								}
								
								else
								{
									$('#commonForm_'+type_other+'_'+itemNo).html(responseStr);
								}
								$("#div_"+type_other).empty();
								showSuccessAlertMessage(str);
						}
						
						else
						{
							//str=showSuccessAlertMessage(str);
							showSuccessAlertMessage(str);
							//$('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).html(str);
							/*$('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).css({
								display: 'hidden'
							});*/
							$('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).empty();
							//if((type_other == 'spe') && responseText.indexOf('added') > -1)
							//{
								/* var btnHtml = "<div class='edit-tools'>";
								 btnHtml = btnHtml +"<button class='btn edit-btn'><i class='icon-pencil-o'></i>&nbsp;Edit</button>";
								 btnHtml = btnHtml + "<button class='btn delete-btn'><i class='icon-trush-can'></i>&nbsp;Delete</button></div>"
							     $('.'+type_other+'_'+itemNo+' .sub-header').append(btnHtml);*/
								 //$('btnAdd_spe').text('Update');
								// $('#addField').val('update');
							     //$('#div_' + type_other + ' form').addClass("view-mode");
							//}
						}
						
						//$("#div_"+type_other).empty();
						
						
						if (type_other=="lan" && $('#commonForm_'+type_other+' form').length == 3){
							$("#btnAdd_" + type_other).hide();
							}
						else if(type_other=="ref" && $('#commonForm_'+type_other+' form').length == 2){
							$("#btnAdd_" + type_other).hide();
						}
						if((type_other == 'spe'))
						{
							$('#txtSkillrea').val("");
						}
						
						if((type_other == 'per'))
						{
							if(isCvPosted != 'True')
							{
							  //(document).on('click', '#btn-save', function(){
  							  $('#perbtn-save').parents('.panel').find('.panel-title a').addClass('collapsed');
  							  $('#perbtn-save').parents('.panel').find('.panel-collapse.collapse').removeClass('in');
							  $('#perbtn-save').parents('.panel').find('.indicator').addClass('icon-plus');

							  // Opening next panel
							  $('#perbtn-save').parents('.panel').next('.panel').find('.panel-title a').removeClass('collapsed');
							  $('#perbtn-save').parents('.panel').next('.panel').find('.panel-title a').removeClass('disabled');
							  $('#perbtn-save').parents('.panel').next('.panel').find('.indicator').removeClass('icon-plus').addClass('icon-minus');
							  
							  $('#perbtn-save').parents('.panel').next('.panel').find('.panel-collapse.collapse').addClass('in').css('height','auto');

							  // Scrolling to the next panel
							  var panel = $('.resume-panel-group').find('.collapse.in');
							  $('html, body').animate({
									scrollTop: panel.offset().top -80
							  }, 800);
							  $('#addressEditBtn').trigger('click');
							
							//});
							
							}
							
							
							//this for dropdown hidden
							if($('#cboMStatus').hasClass('btn-form-control'))       
							{
								$('#cboMStatus').removeClass('btn-form-control');
								$('#cboMStatus').removeClass('hidden');
							}
						}
						
						if((type_other == 'adrs'))
						{
							if($('.collapsed').hasClass('disabled'))
							{
								$('.collapsed').removeClass('disabled')	;
								$('.btn-tab-education').removeClass('disabled')	;
								$('.btn-tab-employment').removeClass('disabled')	;
								$('.btn-tab-others').removeClass('disabled')	;
								$('.btn-tab-photograph').removeClass('disabled')	;
								
							}
						}
						
						$("#btnAdd_" + type_other).prop('disabled', false);
						

					}
				else
					{
						if((type_other == 'spe'))
						{
							$('#noData_spe').css({
								display: 'inline'
							});
							$('.spe_0').empty();
							$("#btnAdd_" + type_other).prop('disabled', false);
						}
						//alert(responseText)
						//var str = responseText;
						var str = showFailAlertMessage(responseText);
						//$('#alertDiv_'+type_other+'_'+itemNo).removeClass("hidden alert-success")
						//$('#alertDiv_'+type_other+'_'+itemNo).addClass("alert-danger");
						$('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).empty();
						$('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).removeClass("hidden");
						$('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).html(str);
						
					}
					
					console.log(responseText);
			},
			error: function(responseText){
				console.log(responseText);
				//alert(responseText);
			},
			complete: function() {
			  $('#div_'+type_other+' #'+formName+' .btn-primary').removeAttr("disabled"); // will fire either on success or error
			}
		});
}



function confirmation_new(ID,tableName,url,itemNo,type_other)
{
	
	//console.log(lang);
	if(lang == "EN")
	{
		msg="Are you sure, you want to delete this record?";
	}else
	{
		msg="আপনি কি স্থায়ীভাবে এই তথ্য গুলি বাদ দেয়ার ব্যাপারে নিশ্চিত?";
	}
	var t=window.confirm(msg);
	if (t)
 	{
	
		$.ajax({
				type: "POST",
				url: url,
				//data:  ID,tableName,
				data:{ID:ID, tableName:tableName},
				//data: "{'ID':'" + ID+ "', 'tableName':'" + tableName+ "'}",
				cache: false,
				dataType: "html",
				success: function(responseText){
					if(responseText.indexOf('deleted') > -1 )
						{
							//setViewMode(divID);
							//alert(itemNo)
							//window.location.reload();
							//var str = showSuccessAlertMessage(responseText);
							if(lang == "EN")
							{
								responseMessage = "The information has been deleted successfully"
							}else
							{
								responseMessage = "তথ্য সফলভাবে ডিলিট করা হয়েছে"
							}
					
						
						if (responseText.indexOf('update') )
						{
							
							location.reload(true);
							
						}
							showSuccessDeleteMessage(responseMessage);
							$('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).empty();
							$('.'+type_other+'_'+itemNo+' .sub-header').hide();
							$('#commonForm_'+type_other+'_'+itemNo+' .panel-body').css('border-top','none');
							$('#commonForm_'+type_other+'_'+itemNo).empty();
							//$('#'+type_other+'Form_'+itemNo).remove();
							
							//$('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).removeClass("hidden");
							//$('#alertDiv_'+type_other+'_'+itemNo).addClass("alert-success");
							//$('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).html(str);
							$('#commonForm_'+type_other+'_'+itemNo).html(str);
							if($('#commonForm_'+type_other+' form').length == 0){
							//if (itemNo==0){
									$("#noData_" + type_other).show();
									//$("commonForm_"+type_other).append()
							}
							if (type_other=="lan" && $('#commonForm_'+type_other+' form').length < 3){
								$("#btnAdd_" + type_other).show();
							}
							else if(type_other=="ref" && $('#commonForm_'+type_other+' form').length < 2){
								$("#btnAdd_" + type_other).show();
							}
							
							/*if ((responseText.indexOf('added') > -1) && (itemNo>=2)){
								$("#btnAdd_"+type_other).hide();
								}*/
							//window.setTimeout(function(){$('body').load(window.location.href + '#body')},3000);	
							//window.setTimeout(function(){location.reload()},3000)
							  
	
						}
					else
						{
							//alert(responseText)
							//var str = responseText;
							var str = showFailAlertMessage(responseText);
							//$('#alertDiv_'+type_other+'_'+itemNo).removeClass("hidden alert-success")
							//$('#alertDiv_'+type_other+'_'+itemNo).addClass("alert-danger");
							$('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).empty();
							$('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other ).removeClass("hidden");
							$('.'+type_other+'_'+itemNo+' #alertDiv_'+type_other).html(str);
							
						}
						console.log(responseText);
				},
				error: function(responseText){
					console.log(responseText);
					alert(responseText);
				},
			});
		
	}
	else
	{
		return false;
	}
}


function closeDiv(type_other)
{
	  $('#btnAdd_'+type_other).prop('disabled', false);
	  $("#div_"+type_other).empty();
	  //$('#alertDiv_'+type+'_'+itemNo).hide();
	  //$("#btnAdd_"+type).show();
	  if((type_other == 'spe'))
		{
			$('#noData_spe').css({
				display: 'inline'
			});
			$('.spe_0').hide();
			$("#btnAdd_" + type_other).prop('disabled', false);
		}
		if($('#commonForm_'+type_other+' form').length == 0)
		{
			$("#noData_" + type_other).show();
					
		}
	  $("#btnAdd_" + type_other).prop('disabled', false);
	  //$("#noData_"+type).show();
	  //$("#body").load(document.URL + "#body");
}



function showSuccessAlertMessage_old(strMsg)
{
	var msgDiv = "<div class='alert alert-success alert-dismissible m-t-20 m-b-0' role='alert'>";
	    msgDiv = msgDiv + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>";
		msgDiv = msgDiv + strMsg;
		msgDiv = msgDiv + "</div>";
		
		return msgDiv;
}

function showSuccessAlertMessage(strMsg)
{
	if( $( ".confirmation-message").hasClass("delete"))
	{
		$( ".confirmation-message").removeClass("delete")
	}
	
	 $( ".confirmation-message").animate({
			opacity: 1,
			bottom: "+50",
			display: "block"
		  }, function() {
      });
	  $(".confirmation-message #c_msg").text(strMsg);
      $(".confirmation-message").show();
	  
	  $( ".confirmation-message").delay(5000).animate({
                      opacity: 1,
                      bottom: "-60",
                      display: "block"
                    }, function() {
  });
  
  
}

function showSuccessDeleteMessage(strMsg)
{
	 $( ".confirmation-message").addClass("delete")
	 $( ".confirmation-message").animate({
			opacity: 1,
			bottom: "+50",
			display: "block"
		  }, function() {
      });
	  $(".confirmation-message #c_msg").text(strMsg);
      $(".confirmation-message").show();
	  
	  $( ".confirmation-message").delay(5000).animate({
                      opacity: 1,
                      bottom: "-60",
                      display: "block"
                    }, function() {
  });
   // setTimeout(function(){
    //                       $(".confirmation-message.server-error").removeClass('server-error');
   //                }, 5000);
  
}

//function showFailAlertMessage(strMsg)
//{
//	var msgDiv = "<div class='alert alert-danger alert-dismissible m-t-20 m-b-0' role='alert'>";
//	    msgDiv = msgDiv + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>";
//		msgDiv = msgDiv + strMsg;
//		msgDiv = msgDiv + "</div>";
//		
//		return msgDiv;
//}



